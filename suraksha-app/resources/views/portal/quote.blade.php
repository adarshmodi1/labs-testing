@extends('layouts.portal')
@section('title', $q->ref)
@section('content')
<p class="small"><a href="{{ route('portal.quotes') }}">← Quotes</a></p>
<div class="ph"><div><h1>{{ $q->line }} · {{ $q->renewal_id ? 'renewal' : 'new cover' }} options</h1>
  <p>{{ $q->ref }} · prepared by {{ $q->rm?->name }} · sent {{ $q->sent_at->format('d M Y') }}@if($q->renewal) · current policy with {{ $q->renewal->policy->insurer->short_name }} expires {{ $q->renewal->policy->end_date->format('d M Y') }}@endif</p></div>
  <div class="sp"></div><span class="pill {{ $q->status === 'Sent to client' ? 'gold' : stage_class($q->status) }}" style="font-size:13px;padding:5px 12px">{{ $q->status === 'Sent to client' ? 'Awaiting your approval' : $q->status }}</span></div>
@if($q->recommendation_note)
<div class="card mb" style="background:var(--gold50);border-color:#EADDBB"><div class="bd" style="display:flex;gap:12px">
  <div class="av gold" style="width:38px;height:38px">★</div>
  <div><b style="color:var(--navy)">Why Suraksha recommends this option</b><p style="margin-top:4px">{{ $q->recommendation_note }}</p></div>
</div></div>
@endif
@if($q->current_premium)<p class="small muted mb">Your current premium is {{ inr($q->current_premium) }} before GST.</p>@endif
@include('quotations._compare', ['opts' => $q->options, 'admin' => false])
<p class="small muted mt">Approving tells Suraksha which option to place. Your RM will confirm the final terms and payment details before the policy is issued.</p>
@endsection
