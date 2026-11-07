<?php

namespace App\Http\Controllers;

use App\Models\Posp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PospController extends Controller
{
    public function index(Request $r)
    {
        $q = Posp::with('rm')->withCount('policies')->withSum('policies', 'premium')->orderBy('name');
        if ($r->filled('status')) $q->where('status', $r->status);
        $posps = $q->get();
        $counts = Posp::selectRaw('status, count(*) n')->groupBy('status')->pluck('n', 'status');
        return view('posps.index', compact('posps', 'counts'));
    }

    public function create()
    {
        $next = 'SUR-POSP-' . str_pad((string) ((int) Posp::max('id') + 101), 4, '0', STR_PAD_LEFT);
        return view('posps.form', ['posp' => new Posp(['code' => $next, 'status' => 'Applied', 'exam_status' => 'Not taken']), 'rms' => $this->rms()]);
    }

    public function store(Request $r)
    {
        $p = Posp::create($this->validated($r));
        return redirect()->route('posps.show', $p)->with('ok', 'POSP agent added.');
    }

    public function show(Posp $posp)
    {
        $posp->load(['policies' => fn ($q) => $q->with('client', 'insurer')->latest('start_date'), 'leads', 'rm']);
        return view('posps.show', compact('posp'));
    }

    public function edit(Posp $posp) { return view('posps.form', ['posp' => $posp, 'rms' => $this->rms()]); }

    public function update(Request $r, Posp $posp)
    {
        $posp->update($this->validated($r, $posp));
        return redirect()->route('posps.show', $posp)->with('ok', 'Saved.');
    }

    private function rms() { return User::where('role', 'rm')->orderBy('name')->get(); }

    private function validated(Request $r, ?Posp $p = null): array
    {
        $data = $r->validate([
            'code' => ['required', 'string', 'max:30', Rule::unique('posps')->ignore($p?->id)], 'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20', 'email' => 'nullable|email', 'pan' => ['nullable', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/'],
            'city' => 'required|string|max:60', 'qualification' => 'nullable|string|max:60', 'training_hours' => 'nullable|integer|min:0|max:50',
            'exam_status' => 'required|in:Not taken,Passed,Failed', 'certificate_no' => 'nullable|string|max:60', 'certified_on' => 'nullable|date',
            'status' => ['required', Rule::in(Posp::STATUSES)], 'bank_name' => 'nullable|string|max:60', 'account_last4' => 'nullable|digits:4',
            'rm_id' => 'nullable|exists:users,id',
        ], ['pan.regex' => 'PAN should look like ABCDE1234F.']);
        if (in_array($data['status'], ['Certified', 'Active']) && ($data['training_hours'] ?? 0) < 15) {
            abort(back()->withInput()->with('bad', 'IRDAI requires 15 hours of training before a POSP is certified.'));
        }
        if (in_array($data['status'], ['Certified', 'Active']) && $data['exam_status'] !== 'Passed') {
            abort(back()->withInput()->with('bad', 'The POSP must pass the exam before being certified.'));
        }
        $data['training_hours'] = $data['training_hours'] ?? 0;
        return $data;
    }
}
