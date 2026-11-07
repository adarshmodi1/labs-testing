<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Insurer;
use App\Models\Lead;
use App\Models\LeadActivity;
use App\Models\Policy;
use App\Models\Quotation;
use App\Models\QuoteOption;
use App\Models\Renewal;
use App\Models\User;
use App\Services\QuoteReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
{
    public function index(Request $r)
    {
        $q = Quotation::with('options.insurer', 'rm', 'client', 'lead')->latest();
        if ($r->filled('status')) $q->where('status', $r->status);
        if ($r->filled('type')) $r->type === 'renewal' ? $q->whereNotNull('renewal_id') : $q->whereNull('renewal_id');
        $quotes = $q->get();
        $counts = Quotation::selectRaw('status, count(*) n')->groupBy('status')->pluck('n', 'status');
        return view('quotations.index', compact('quotes', 'counts'));
    }

    public function create(Request $r)
    {
        $q = new Quotation(['status' => 'Requested']);
        if ($r->filled('lead')) {
            $lead = Lead::findOrFail($r->lead);
            $q->fill(['lead_id' => $lead->id, 'client_id' => $lead->client_id, 'prospect_name' => $lead->company, 'line' => $lead->linesArray()[0] ?? null, 'rm_id' => $lead->rm_id]);
        } elseif ($r->filled('renewal')) {
            $rn = Renewal::with('policy.client')->findOrFail($r->renewal);
            $p = $rn->policy;
            $q->fill(['renewal_id' => $rn->id, 'client_id' => $p->client_id, 'prospect_name' => $p->client->name, 'line' => $p->line, 'sum_insured' => $p->sum_insured, 'current_premium' => $p->premium, 'rm_id' => $p->rm_id,
                'requirement' => "Renewal of {$p->line} policy {$p->policy_no} with {$p->insurer->short_name}, expiring {$p->end_date->format('d M Y')}. Sum insured " . inr($p->sum_insured) . '.']);
        } elseif ($r->filled('client')) {
            $c = Client::findOrFail($r->client);
            $q->fill(['client_id' => $c->id, 'prospect_name' => $c->name, 'rm_id' => $c->rm_id]);
        }
        return view('quotations.create', ['q' => $q, 'lines' => array_keys(Policy::LINES), 'rms' => User::whereIn('role', ['rm', 'business_head'])->orderBy('name')->get(), 'clients' => Client::orderBy('name')->get()]);
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'prospect_name' => 'required|string|max:150', 'client_id' => 'nullable|exists:clients,id', 'lead_id' => 'nullable|exists:leads,id',
            'renewal_id' => 'nullable|exists:renewals,id', 'line' => ['required', Rule::in(array_keys(Policy::LINES))], 'sum_insured' => 'nullable|numeric|min:0',
            'current_premium' => 'nullable|numeric|min:0', 'requirement' => 'nullable|string|max:3000', 'rm_id' => 'nullable|exists:users,id',
        ]);
        if (! empty($data['client_id']) && empty($data['lead_id']) && empty($data['renewal_id'])) $data['prospect_name'] = Client::find($data['client_id'])->name;
        $q = Quotation::create($data + ['ref' => Quotation::nextRef(), 'status' => 'Requested']);
        if ($q->lead_id) {
            $q->lead->update(['stage' => 'Quotation']);
            LeadActivity::create(['lead_id' => $q->lead_id, 'user_id' => auth()->id(), 'type' => 'Note', 'note' => "Quotation {$q->ref} started for {$q->line}."]);
        }
        if ($q->renewal_id && in_array($q->renewal->stage, ['Not started', 'Data requested', 'Data received'])) $q->renewal->update(['stage' => 'Data received']);
        return redirect()->route('quotations.show', $q)->with('ok', 'Quotation started. Add each insurer’s quote by hand or upload their PDF.');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load('options.insurer', 'client.portalUsers', 'lead', 'renewal.policy.insurer', 'rm', 'approvedOption.insurer');
        return view('quotations.show', [
            'q' => $quotation, 'insurers' => Insurer::orderBy('short_name')->get(),
            'draft' => session('ai_draft_' . $quotation->id), 'hasKey' => (bool) QuoteReader::apiKey(),
        ]);
    }

    public function addOption(Request $r, Quotation $quotation)
    {
        $data = $r->validate([
            'insurer_id' => 'required|exists:insurers,id', 'option_label' => 'nullable|string|max:100', 'premium' => 'required|numeric|min:1',
            'gst' => 'nullable|numeric|min:0', 'sum_insured' => 'nullable|numeric|min:0', 'deductible' => 'nullable|string|max:150',
            'key_covers' => 'nullable|string|max:3000', 'exclusions' => 'nullable|string|max:3000', 'valid_until' => 'nullable|date',
            'source' => 'nullable|in:Manual,AI', 'pdf_path' => 'nullable|string', 'ai_meta' => 'nullable|string',
        ]);
        $data['gst'] = $data['gst'] ?? round($data['premium'] * 0.18, 2);
        $data['source'] = $data['source'] ?? 'Manual';
        if (! empty($data['pdf_path']) && ! str_starts_with($data['pdf_path'], "quotes/{$quotation->id}/")) unset($data['pdf_path']);
        $data['ai_meta'] = ! empty($data['ai_meta']) ? json_decode($data['ai_meta'], true) : null;
        $quotation->options()->create($data);
        if (in_array($quotation->status, ['Draft', 'Requested'])) $quotation->update(['status' => 'Quotes received']);
        if ($quotation->renewal && in_array($quotation->renewal->stage, ['Not started', 'Data requested', 'Data received'])) $quotation->renewal->update(['stage' => 'Quotes in']);
        session()->forget('ai_draft_' . $quotation->id);
        return redirect()->route('quotations.show', $quotation)->with('ok', 'Quote added to the comparison.');
    }

    public function aiRead(Request $r, Quotation $quotation, QuoteReader $reader)
    {
        $r->validate(['pdf' => 'required|file|mimes:pdf|max:15360']);
        $path = $r->file('pdf')->store("quotes/{$quotation->id}", 'local');
        try {
            $data = $reader->read(Storage::disk('local')->get($path), $quotation->line);
        } catch (\Throwable $e) {
            return back()->with('bad', $e->getMessage());
        }
        session(['ai_draft_' . $quotation->id => $data + ['pdf_path' => $path, 'file_name' => $r->file('pdf')->getClientOriginalName()]]);
        return redirect()->route('quotations.show', $quotation)->with('ok', 'AI has read the PDF. Check the highlighted fields, then add it to the comparison.');
    }

    public function aiDiscard(Quotation $quotation)
    {
        session()->forget('ai_draft_' . $quotation->id);
        return back();
    }

    public function recommend(Quotation $quotation, QuoteOption $option)
    {
        abort_unless($option->quotation_id === $quotation->id, 404);
        $quotation->options()->update(['is_recommended' => false]);
        $option->update(['is_recommended' => true, 'show_to_client' => true]);
        return back()->with('ok', $option->insurer->short_name . ' marked as Suraksha’s recommendation.');
    }

    public function toggleVisibility(Quotation $quotation, QuoteOption $option)
    {
        abort_unless($option->quotation_id === $quotation->id, 404);
        $option->update(['show_to_client' => ! $option->show_to_client]);
        return back();
    }

    public function deleteOption(Quotation $quotation, QuoteOption $option)
    {
        abort_unless($option->quotation_id === $quotation->id, 404);
        $option->delete();
        return back()->with('ok', 'Quote removed.');
    }

    public function send(Request $r, Quotation $quotation)
    {
        $data = $r->validate(['recommendation_note' => 'required|string|max:2000']);
        if (! $quotation->client_id) return back()->with('bad', 'Convert the lead to a client first, so the comparison can appear in their portal.');
        if (! $quotation->options()->where('is_recommended', true)->exists()) return back()->with('bad', 'Pick the option Suraksha recommends before sending.');
        $quotation->update($data + ['status' => 'Sent to client', 'sent_at' => now()]);
        $hasLogin = $quotation->client->portalUsers()->exists();
        return back()->with('ok', 'Sent. ' . ($hasLogin ? 'The client can now compare and approve it in their portal.' : 'This client has no portal login yet – create one from the client page.'));
    }

    public function status(Request $r, Quotation $quotation)
    {
        $data = $r->validate(['status' => ['required', Rule::in(Quotation::STATUSES)], 'option_id' => 'nullable|exists:quote_options,id']);
        $upd = ['status' => $data['status']];
        if ($data['status'] === 'Approved') {
            $opt = $data['option_id'] ?? $quotation->options()->where('is_recommended', true)->value('id');
            if (! $opt) return back()->with('bad', 'Choose which option the client approved.');
            $upd += ['approved_option_id' => $opt, 'approved_at' => now(), 'approved_by' => auth()->user()->name . ' (on behalf of client)'];
            if ($quotation->renewal) $quotation->renewal->update(['stage' => 'Client approved']);
        }
        $quotation->update($upd);
        return back()->with('ok', 'Status updated.');
    }
}
