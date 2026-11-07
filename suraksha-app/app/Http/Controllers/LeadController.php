<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\Policy;
use App\Models\Posp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LeadController extends Controller
{
    public function index(Request $r)
    {
        $q = Lead::with('rm', 'posp')->latest();
        if ($r->filled('rm')) $q->where('rm_id', $r->rm);
        if ($r->filled('segment')) $q->where('segment', $r->segment);
        if ($r->filled('q')) $q->where(fn ($w) => $w->where('company', 'like', "%{$r->q}%")->orWhere('contact_person', 'like', "%{$r->q}%")->orWhere('city', 'like', "%{$r->q}%"));
        $leads = $q->get();
        $view = $r->get('view', 'board');
        $rms = User::where('role', 'rm')->orderBy('name')->get();
        $overdue = $leads->filter(fn ($l) => $l->next_follow_up && $l->next_follow_up->isPast() && ! in_array($l->stage, ['Won', 'Lost']));
        return view('leads.index', compact('leads', 'view', 'rms', 'overdue'));
    }

    public function create()
    {
        return view('leads.form', ['lead' => new Lead(['stage' => 'New', 'segment' => 'SME', 'source' => 'Referral']), ...$this->options()]);
    }

    public function store(Request $r)
    {
        $data = $this->validated($r);
        $lead = Lead::create($data);
        LeadActivity::create(['lead_id' => $lead->id, 'user_id' => auth()->id(), 'type' => 'Note', 'note' => 'Lead created from ' . $lead->source . '.']);
        return redirect()->route('leads.show', $lead)->with('ok', 'Lead added.');
    }

    public function show(Lead $lead)
    {
        $lead->load('activities.user', 'rm', 'posp', 'quotations.options', 'client');
        return view('leads.show', compact('lead'));
    }

    public function edit(Lead $lead) { return view('leads.form', ['lead' => $lead, ...$this->options()]); }

    public function update(Request $r, Lead $lead)
    {
        $lead->update($this->validated($r));
        return redirect()->route('leads.show', $lead)->with('ok', 'Lead updated.');
    }

    public function stage(Request $r, Lead $lead)
    {
        $data = $r->validate(['stage' => ['required', Rule::in(Lead::STAGES)], 'lost_reason' => 'nullable|string|max:200']);
        if ($data['stage'] === 'Lost' && empty($data['lost_reason'])) return back()->with('bad', 'Add a reason when marking a lead as lost.');
        $old = $lead->stage;
        $lead->update($data + ['next_follow_up' => in_array($data['stage'], ['Won', 'Lost']) ? null : $lead->next_follow_up]);
        LeadActivity::create(['lead_id' => $lead->id, 'user_id' => auth()->id(), 'type' => 'Stage change', 'note' => "$old → {$data['stage']}" . (! empty($data['lost_reason']) ? ' (' . $data['lost_reason'] . ')' : '')]);
        return back()->with('ok', 'Stage moved to ' . $data['stage'] . '.');
    }

    public function activity(Request $r, Lead $lead)
    {
        $data = $r->validate(['type' => 'required|in:Call,Meeting,Email,WhatsApp,Note', 'note' => 'required|string|max:2000', 'next_follow_up' => 'nullable|date']);
        LeadActivity::create(['lead_id' => $lead->id, 'user_id' => auth()->id(), 'type' => $data['type'], 'note' => $data['note']]);
        if (! empty($data['next_follow_up'])) $lead->update(['next_follow_up' => $data['next_follow_up']]);
        if ($lead->stage === 'New') $lead->update(['stage' => 'Contacted']);
        return back()->with('ok', 'Activity logged.');
    }

    /** Won lead → client record (policies are booked when issued). */
    public function convert(Lead $lead)
    {
        if ($lead->client_id) return redirect()->route('clients.show', $lead->client_id);
        $client = Client::create([
            'name' => $lead->company, 'segment' => $lead->segment, 'industry' => $lead->industry, 'city' => $lead->city,
            'contact_person' => $lead->contact_person, 'phone' => $lead->phone, 'email' => $lead->email ?? 'not-given@example.com',
            'rm_id' => $lead->rm_id, 'posp_id' => $lead->posp_id, 'client_since' => now(),
        ]);
        $lead->update(['client_id' => $client->id, 'stage' => 'Won']);
        $lead->quotations()->update(['client_id' => $client->id]);
        LeadActivity::create(['lead_id' => $lead->id, 'user_id' => auth()->id(), 'type' => 'Stage change', 'note' => 'Converted to client.']);
        return redirect()->route('clients.show', $client)->with('ok', 'Client created from the lead. Its quotations moved across.');
    }

    private function options(): array
    {
        return [
            'rms' => User::where('is_active', true)->whereIn('role', ['rm', 'business_head'])->orderBy('name')->get(),
            'posps' => Posp::whereIn('status', ['Active', 'Certified'])->orderBy('name')->get(),
            'lines' => array_keys(Policy::LINES),
        ];
    }

    private function validated(Request $r): array
    {
        $data = $r->validate([
            'company' => 'required|string|max:150', 'contact_person' => 'required|string|max:100', 'phone' => 'required|string|max:20',
            'email' => 'nullable|email', 'city' => 'required|string|max:60', 'industry' => 'nullable|string|max:80',
            'segment' => ['required', Rule::in(Client::SEGMENTS)], 'source' => ['required', Rule::in(Lead::SOURCES)],
            'lines' => 'required|array|min:1', 'lines.*' => Rule::in(array_keys(Policy::LINES)),
            'expected_premium' => 'nullable|numeric|min:0', 'stage' => ['required', Rule::in(Lead::STAGES)],
            'next_follow_up' => 'nullable|date', 'rm_id' => 'nullable|exists:users,id', 'posp_id' => 'nullable|exists:posps,id', 'notes' => 'nullable|string|max:3000',
        ]);
        $data['lines'] = implode(', ', $data['lines']);
        $data['expected_premium'] = $data['expected_premium'] ?? 0;
        return $data;
    }
}
