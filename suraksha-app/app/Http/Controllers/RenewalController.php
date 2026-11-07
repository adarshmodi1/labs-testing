<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Renewal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RenewalController extends Controller
{
    public function index(Request $r)
    {
        $due = (int) $r->get('due', 90);
        $all = Renewal::with('policy.client', 'policy.insurer', 'owner', 'quotations')
            ->whereIn('stage', Renewal::OPEN)->get()
            ->filter(fn ($x) => $x->policy->daysToExpiry() <= $due);
        $stageCounts = collect(Renewal::OPEN)->mapWithKeys(fn ($s) => [$s => ['n' => $all->where('stage', $s)->count(), 'p' => $all->where('stage', $s)->sum(fn ($x) => (float) $x->policy->premium)]]);
        $list = $all;
        if ($r->filled('stage')) $list = $list->where('stage', $r->stage);
        if ($r->filled('owner')) $list = $list->where('owner_id', (int) $r->owner);
        if ($r->filled('line')) $list = $list->filter(fn ($x) => $x->policy->category() === $r->line);
        if ($r->boolean('risk')) $list = $list->filter->isAtRisk();
        $list = $list->sortBy(fn ($x) => $x->policy->end_date)->values();
        $owners = User::where('role', 'rm')->orderBy('name')->get();
        $recent = Renewal::with('policy.client')->whereIn('stage', ['Renewed', 'Lost'])->latest('updated_at')->take(6)->get();
        $categories = collect(Policy::LINES)->unique()->values();
        return view('renewals.index', compact('list', 'all', 'stageCounts', 'due', 'owners', 'recent', 'categories'));
    }

    public function stage(Request $r, Renewal $renewal)
    {
        $data = $r->validate(['stage' => ['required', Rule::in(Renewal::STAGES)], 'lost_reason' => 'nullable|string|max:200', 'note' => 'nullable|string|max:500']);
        if ($data['stage'] === 'Lost' && empty($data['lost_reason'])) return back()->with('bad', 'Add a reason when a renewal is lost.');
        $upd = ['stage' => $data['stage'], 'lost_reason' => $data['lost_reason'] ?? null];
        if (! empty($data['note'])) $upd['notes'] = $data['note'];
        $renewal->update($upd);
        if ($data['stage'] === 'Renewed') {
            $p = $renewal->policy;
            $approved = $renewal->quotations()->whereNotNull('approved_option_id')->latest()->first()?->approvedOption;
            $new = $p->replicate(['status']);
            $new->fill([
                'status' => 'Active', 'start_date' => $p->end_date->copy()->addDay(), 'end_date' => $p->end_date->copy()->addYear(),
                'renewed_from_id' => $p->id, 'policy_no' => 'To be issued',
                'insurer_id' => $approved?->insurer_id ?? $p->insurer_id,
                'premium' => $approved?->premium ?? $p->premium, 'gst' => $approved?->gst ?? $p->gst,
            ])->save();
            $p->update(['status' => 'Renewed']);
            $renewal->update(['renewed_premium' => $new->premium]);
            return back()->with('ok', 'Marked renewed. The new policy record is created – add the policy number once issued.');
        }
        if ($data['stage'] === 'Lost') $renewal->policy->update(['status' => 'Lapsed']);
        return back()->with('ok', 'Renewal moved to ' . $data['stage'] . '.');
    }
}
