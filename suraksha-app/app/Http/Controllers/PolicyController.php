<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index(Request $r)
    {
        $q = Policy::with('client', 'insurer', 'rm', 'posp')->orderBy('end_date');
        $q->where('status', $r->get('status', 'Active'));
        if ($r->filled('insurer')) $q->where('insurer_id', $r->insurer);
        if ($r->filled('q')) $q->where(fn ($w) => $w->where('policy_no', 'like', "%{$r->q}%")->orWhereHas('client', fn ($c) => $c->where('name', 'like', "%{$r->q}%")));
        $policies = $q->get();
        if ($r->filled('category')) $policies = $policies->filter(fn ($p) => $p->category() === $r->category)->values();
        return view('policies.index', ['policies' => $policies, 'insurers' => Insurer::orderBy('short_name')->get(), 'categories' => collect(Policy::LINES)->unique()->values()]);
    }

    public function show(Policy $policy)
    {
        $policy->load('client', 'insurer', 'rm', 'posp', 'renewal', 'claims');
        $history = Policy::with('insurer')->where('client_id', $policy->client_id)->where('line', $policy->line)->orderByDesc('start_date')->get();
        return view('policies.show', compact('policy', 'history'));
    }
}
