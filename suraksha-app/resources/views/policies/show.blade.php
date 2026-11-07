@extends('layouts.app')
@section('title', $policy->line)
@section('crumb', 'Book · Policies')
@section('content')
<div class="ph">
  <div><h1>{{ $policy->line }}</h1><p><a href="{{ route('clients.show', $policy->client) }}">{{ $policy->client->name }}</a> · {{ $policy->insurer->name }} · {{ $policy->policy_no }}</p></div>
  <div class="sp"></div><span class="pill {{ stage_class($policy->status) }}">{{ $policy->status }}</span>
</div>
<div class="grid g4 mb">
  <div class="kpi"><div class="l">Sum insured</div><div class="v" style="font-size:20px">{{ inr($policy->sum_insured) }}</div></div>
  <div class="kpi"><div class="l">Premium (before GST)</div><div class="v" style="font-size:20px">{{ inr($policy->premium) }}</div><div class="s">GST {{ inr($policy->gst) }} · total {{ inr($policy->totalPremium()) }}</div></div>
  <div class="kpi"><div class="l">Commission</div><div class="v" style="font-size:20px">{{ inr($policy->commission()) }}</div><div class="s">{{ $policy->commission_rate + 0 }}% of premium</div></div>
  <div class="kpi {{ $policy->status === 'Active' && $policy->daysToExpiry() <= 30 ? 'gold' : '' }}"><div class="l">Period</div><div class="v" style="font-size:20px">{{ $policy->end_date->format('d M Y') }}</div><div class="s">From {{ $policy->start_date->format('d M Y') }}@if($policy->status === 'Active') · {{ days_label($policy->daysToExpiry(), ' left') }} @endif</div></div>
</div>
<div class="grid g2">
  <div class="card"><div class="hd"><h2>Details</h2></div><div class="bd"><dl class="kv">
    <dt>Category</dt><dd>{{ $policy->category() }}</dd><dt>Risk location</dt><dd>{{ $policy->risk_location }}</dd>
    <dt>RM</dt><dd>{{ $policy->rm?->name }}</dd><dt>POSP</dt><dd>{{ $policy->posp?->name ?? '—' }}</dd>
    <dt>Renewal</dt><dd>@if($policy->renewal)<span class="pill {{ stage_class($policy->renewal->stage) }}">{{ $policy->renewal->stage }}</span> <a href="{{ route('renewals.index') }}" class="small">Renewals →</a>@else — @endif</dd>
  </dl></div></div>
  <div class="card"><div class="hd"><h2>History for this line</h2></div><div class="bd flush"><table class="t">
    @foreach($history as $h)<tr><td>{{ $h->start_date->format('M Y') }} – {{ $h->end_date->format('M Y') }}</td><td>{{ $h->insurer->short_name }}</td><td class="num">{{ inr($h->premium) }}</td><td><span class="pill {{ stage_class($h->status) }}">{{ $h->status }}</span></td></tr>@endforeach
  </table></div></div>
</div>
@if($policy->claims->count())
<div class="card mt"><div class="hd"><h2>Claims</h2></div><div class="bd flush"><table class="t">
  @foreach($policy->claims as $c)<tr><td><a href="{{ route('claims.show', $c) }}">{{ $c->ref }}</a></td><td>{{ $c->loss_type }}</td><td>{{ $c->loss_date->format('d M Y') }}</td><td class="num">{{ inr($c->estimated_amount) }}</td><td><span class="pill {{ stage_class($c->status) }}">{{ $c->status }}</span></td></tr>@endforeach
</table></div></div>
@endif
@endsection
