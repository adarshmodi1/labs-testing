@extends('layouts.portal')
@section('content')
<div class="ph"><div><h1>Hello, {{ explode(' ', auth('customer')->user()->name)[0] }}</h1><p>{{ $c->name }} · {{ $policies->count() }} active policies with Suraksha</p></div>
<div class="sp"></div><a class="btn teal" href="{{ route('portal.claims.new') }}">Report a claim</a></div>

@foreach($quotes as $q)
<div class="card mb" style="border:2px solid var(--gold)"><div class="bd" style="display:flex;gap:14px;align-items:center;flex-wrap:wrap">
  <div style="flex:1;min-width:240px"><span class="pill gold">Action needed</span><h2 style="margin-top:6px">{{ $q->line }} renewal quotes are ready</h2><p class="muted small">{{ $q->options->where('show_to_client', true)->count() }} insurers compared · Suraksha’s recommendation inside</p></div>
  <a class="btn gold" href="{{ route('portal.quote', $q) }}">Compare &amp; approve →</a>
</div></div>
@endforeach

<div class="grid g4 mb">
  <div class="kpi dark"><div class="l">Active policies</div><div class="v">{{ $policies->count() }}</div><div class="s">Total premium {{ inr_short($policies->sum(fn ($p) => $p->totalPremium())) }} incl. GST</div></div>
  <div class="kpi"><div class="l">Total sum insured</div><div class="v">{{ inr_short($policies->sum('sum_insured')) }}</div></div>
  <div class="kpi {{ $upcoming->count() ? 'gold' : '' }}"><div class="l">Renewals in next 90 days</div><div class="v">{{ $upcoming->count() }}</div><div class="s">{{ $upcoming->first() ? 'Next: ' . $upcoming->first()->line . ' on ' . $upcoming->first()->end_date->format('d M') : '' }}</div></div>
  <div class="kpi"><div class="l">Open claims</div><div class="v">{{ $claims->count() }}</div></div>
</div>

<div class="grid g2">
  <div class="card"><div class="hd"><h2>Coming up for renewal</h2><div class="sp"></div><a class="small" href="{{ route('portal.renewals') }}">All →</a></div><div class="bd flush"><table class="t">
    @forelse($upcoming as $p)<tr><td><a href="{{ route('portal.policy', $p) }}"><b>{{ $p->line }}</b></a><div class="sub">{{ $p->insurer->short_name }}</div></td><td class="nowrap">{{ $p->end_date->format('d M Y') }}<div class="sub {{ $p->daysToExpiry() <= 30 ? 'down' : '' }}">{{ days_label($p->daysToExpiry()) }}</div></td></tr>
    @empty<tr><td class="empty">Nothing due in the next 90 days.</td></tr>@endforelse
  </table></div></div>
  <div class="card"><div class="hd"><h2>Your claims</h2><div class="sp"></div><a class="small" href="{{ route('portal.claims') }}">All →</a></div><div class="bd flush"><table class="t">
    @forelse($claims as $cl)<tr><td><a href="{{ route('portal.claim', $cl) }}"><b>{{ $cl->ref }}</b></a><div class="sub">{{ $cl->loss_type }} · {{ $cl->policy->line }}</div></td><td><span class="pill {{ stage_class($cl->status) }}">{{ $cl->status }}</span><div class="sub">Updated {{ $cl->updated_at->diffForHumans() }}</div></td></tr>
    @empty<tr><td class="empty">No open claims.</td></tr>@endforelse
  </table></div></div>
</div>
@endsection
