<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\ClaimUpdate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClaimController extends Controller
{
    public function index(Request $r)
    {
        $q = Claim::with('client', 'policy.insurer', 'handler')->latest();
        if ($r->filled('status')) $q->where('status', $r->status);
        elseif (! $r->boolean('all')) $q->whereIn('status', Claim::OPEN);
        $claims = $q->get();
        $counts = Claim::selectRaw('status, count(*) n')->groupBy('status')->pluck('n', 'status');
        return view('claims.index', compact('claims', 'counts'));
    }

    public function show(Claim $claim)
    {
        $claim->load('client', 'policy.insurer', 'handler', 'updates.user');
        return view('claims.show', ['claim' => $claim, 'handlers' => User::whereIn('role', ['claims', 'rm', 'operations', 'business_head'])->orderBy('name')->get()]);
    }

    public function update(Request $r, Claim $claim)
    {
        $data = $r->validate([
            'status' => ['required', Rule::in(Claim::STATUSES)], 'note' => 'required|string|max:1000', 'visible_to_client' => 'nullable|boolean',
            'insurer_claim_no' => 'nullable|string|max:60', 'settled_amount' => 'nullable|numeric|min:0', 'handler_id' => 'nullable|exists:users,id',
        ]);
        $claim->update(array_filter([
            'status' => $data['status'], 'insurer_claim_no' => $data['insurer_claim_no'] ?? null,
            'settled_amount' => $data['settled_amount'] ?? null, 'handler_id' => $data['handler_id'] ?? null,
        ], fn ($v) => $v !== null && $v !== ''));
        ClaimUpdate::create(['claim_id' => $claim->id, 'user_id' => auth()->id(), 'status' => $data['status'], 'note' => $data['note'], 'visible_to_client' => $r->boolean('visible_to_client')]);
        return back()->with('ok', 'Claim updated' . ($r->boolean('visible_to_client') ? ' – the client can see this update.' : '.'));
    }
}
