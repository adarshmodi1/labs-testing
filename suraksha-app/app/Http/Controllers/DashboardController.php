<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Client;
use App\Models\Lead;
use App\Models\Policy;
use App\Models\Quotation;
use App\Models\Renewal;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $fy = fy_start();
        $today = now()->startOfDay();

        $fyPolicies = Policy::where('start_date', '>=', $fy)->where('start_date', '<=', $today)->get();
        $gwp = $fyPolicies->sum(fn ($p) => (float) $p->premium);
        $commission = $fyPolicies->sum(fn ($p) => $p->commission());

        // same period last year, for growth
        $lyStart = $fy->copy()->subYear();
        $lyEnd = $today->copy()->subYear();
        $lyGwp = (float) Policy::whereBetween('start_date', [$lyStart, $lyEnd])->sum('premium');
        $growth = $lyGwp > 0 ? round(($gwp - $lyGwp) / $lyGwp * 100, 1) : null;

        $active = Policy::where('status', 'Active');
        $inForce = (clone $active)->count();
        $inForcePremium = (float) (clone $active)->sum('premium');
        $activeClients = Client::whereHas('policies', fn ($q) => $q->where('status', 'Active'))->count();

        $closed = Renewal::whereIn('stage', ['Renewed', 'Lost'])->where('updated_at', '>=', $today->copy()->subYear())->get();
        $retention = $closed->count() ? round($closed->where('stage', 'Renewed')->count() / $closed->count() * 100, 1) : null;

        $open = Renewal::with('policy.client', 'policy.insurer', 'owner')->whereIn('stage', Renewal::OPEN)->get();
        $due = fn ($d) => $open->filter(fn ($r) => $r->policy->daysToExpiry() <= $d);
        $due30 = $due(30); $due60 = $due(60); $due90 = $due(90);
        $atRisk = $open->filter->isAtRisk();

        $openLeads = Lead::whereNotIn('stage', ['Won', 'Lost'])->get();
        $won = Lead::where('stage', 'Won')->count();
        $lost = Lead::where('stage', 'Lost')->count();
        $conversion = ($won + $lost) ? round($won / ($won + $lost) * 100) : null;

        $openClaims = Claim::whereIn('status', Claim::OPEN)->get();
        $newClaimRequests = Claim::with('client', 'policy')->where('status', 'Requested')->latest()->get();
        $awaitingClient = Quotation::where('status', 'Sent to client')->count();

        // monthly premium written, last 12 months
        $months = collect(range(11, 0))->map(fn ($i) => $today->copy()->startOfMonth()->subMonths($i));
        $monthly = $months->map(fn ($m) => [
            'label' => $m->format('M y'),
            'value' => round((float) Policy::whereBetween('start_date', [$m, $m->copy()->endOfMonth()])->sum('premium') / 1e5, 2),
        ]);

        $byCategory = Policy::where('status', 'Active')->get()->groupBy(fn ($p) => $p->category())
            ->map(fn ($g) => (float) $g->sum('premium'))->sortDesc();
        $byInsurer = Policy::with('insurer')->where('status', 'Active')->get()->groupBy(fn ($p) => $p->insurer->short_name)
            ->map(fn ($g) => (float) $g->sum('premium'))->sortDesc();
        $bySegment = Policy::with('client')->where('status', 'Active')->get()->groupBy(fn ($p) => $p->client->segment)
            ->map(fn ($g) => (float) $g->sum('premium'))->sortDesc();

        $stageCounts = collect(Renewal::OPEN)->mapWithKeys(fn ($s) => [$s => $due90->where('stage', $s)->count()]);

        $rms = User::where('role', 'rm')->get()->map(function ($u) use ($fy, $today, $open, $atRisk) {
            $achieved = (float) Policy::where('rm_id', $u->id)->whereBetween('start_date', [$fy, $today])->sum('premium');
            $elapsed = $fy->diffInDays($today) / 365;
            return (object) [
                'user' => $u, 'achieved' => $achieved, 'target' => (float) $u->annual_target,
                'pct' => $u->annual_target > 0 ? round($achieved / $u->annual_target * 100) : 0,
                'pace' => round($elapsed * 100),
                'renewals' => $open->where('owner_id', $u->id)->filter(fn ($r) => $r->policy->daysToExpiry() <= 90)->count(),
                'atRisk' => $atRisk->where('owner_id', $u->id)->count(),
                'leads' => Lead::where('rm_id', $u->id)->whereNotIn('stage', ['Won', 'Lost'])->count(),
                'pipeline' => (float) Lead::where('rm_id', $u->id)->whereNotIn('stage', ['Won', 'Lost'])->sum('expected_premium'),
            ];
        });

        $next15 = $open->filter(fn ($r) => $r->policy->daysToExpiry() <= 15)->sortBy(fn ($r) => $r->policy->end_date)->take(8);

        return view('dashboard', compact(
            'gwp', 'commission', 'growth', 'inForce', 'inForcePremium', 'activeClients', 'retention', 'closed',
            'due30', 'due60', 'due90', 'atRisk', 'openLeads', 'conversion', 'openClaims', 'newClaimRequests', 'awaitingClient',
            'monthly', 'byCategory', 'byInsurer', 'bySegment', 'stageCounts', 'rms', 'next15'
        ));
    }
}
