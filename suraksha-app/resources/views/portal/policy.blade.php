@extends('layouts.portal')
@section('title', $policy->line)
@section('content')
<p class="small"><a href="{{ route('portal.policies') }}">← My policies</a></p>
<div class="ph"><div><h1>{{ $policy->line }}</h1><p>{{ $policy->insurer->name }} · Policy {{ $policy->policy_no }}</p></div><div class="sp"></div><a class="btn teal" href="{{ route('portal.claims.new', ['policy' => $policy->id]) }}">Report a claim on this policy</a></div>
<div class="grid g4 mb">
  <div class="kpi"><div class="l">Sum insured</div><div class="v" style="font-size:20px">{{ inr($policy->sum_insured) }}</div></div>
  <div class="kpi"><div class="l">Premium</div><div class="v" style="font-size:20px">{{ inr($policy->totalPremium()) }}</div><div class="s">{{ inr($policy->premium) }} + GST {{ inr($policy->gst) }}</div></div>
  <div class="kpi"><div class="l">Valid from</div><div class="v" style="font-size:20px">{{ $policy->start_date->format('d M Y') }}</div></div>
  <div class="kpi {{ $policy->daysToExpiry() <= 30 ? 'gold' : '' }}"><div class="l">Valid till</div><div class="v" style="font-size:20px">{{ $policy->end_date->format('d M Y') }}</div><div class="s">{{ days_label($policy->daysToExpiry(), ' left') }}</div></div>
</div>
<div class="grid g2">
  <div class="card"><div class="hd"><h2>Details</h2></div><div class="bd"><dl class="kv"><dt>Insured location</dt><dd>{{ $policy->risk_location }}</dd><dt>Category</dt><dd>{{ $policy->category() }}</dd><dt>Your RM</dt><dd>{{ $policy->rm?->name }} · {{ $policy->rm?->phone }}</dd>
    <dt>Renewal</dt><dd>{{ $policy->renewal && in_array($policy->renewal->stage, \App\Models\Renewal::OPEN) ? 'In progress – ' . $policy->renewal->stage : 'Not yet due' }}</dd></dl>
    <p class="small muted" style="margin-top:12px">Policy document download will be available once documents are uploaded in the full version.</p></div></div>
  <div class="card"><div class="hd"><h2>Claims on this policy</h2></div><div class="bd flush"><table class="t">
    @forelse($policy->claims as $cl)<tr><td><a href="{{ route('portal.claim', $cl) }}">{{ $cl->ref }}</a><div class="sub">{{ $cl->loss_type }}</div></td><td><span class="pill {{ stage_class($cl->status) }}">{{ $cl->status }}</span></td></tr>@empty<tr><td class="empty">No claims.</td></tr>@endforelse
  </table></div></div>
</div>
@endsection
