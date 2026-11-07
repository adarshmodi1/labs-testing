@extends('layouts.portal')
@section('title', $claim->ref)
@section('content')
@php $flow = ['Requested', 'Intimated to insurer', 'Surveyor appointed', 'Documents pending', 'Under assessment', 'Settled']; $idx = array_search($claim->status, $flow); @endphp
<p class="small"><a href="{{ route('portal.claims') }}">← Claims</a></p>
<div class="ph"><div><h1>Claim {{ $claim->ref }}</h1><p>{{ $claim->loss_type }} · {{ $claim->policy->line }} with {{ $claim->policy->insurer->short_name }} · reported {{ $claim->created_at->format('d M Y') }}</p></div><div class="sp"></div><span class="pill {{ stage_class($claim->status) }}" style="font-size:13px;padding:5px 12px">{{ $claim->status }}</span></div>
<div class="card mb"><div class="bd"><div class="steps">@foreach($flow as $i => $s)<div class="s {{ $idx !== false && $i < $idx ? 'done' : '' }} {{ $idx === $i ? 'cur done' : '' }}">{{ $s }}</div>@endforeach</div>
@if($claim->status === 'Repudiated')<div class="flash bad" style="margin:10px 0 0">The insurer has declined this claim. Your Suraksha claims team will discuss the next steps with you.</div>@endif</div></div>
<div class="grid g-2-1">
  <div class="card"><div class="hd"><h2>Updates</h2></div><div class="bd"><div class="tl">
    @foreach($claim->updates as $u)<div class="it done"><b>{{ $u->status }}</b> <span class="small muted">· {{ $u->created_at->format('d M Y, g:i a') }}</span><div>{{ $u->note }}</div></div>@endforeach
  </div></div></div>
  <div>
    <div class="card"><div class="hd"><h2>Your claims contact</h2></div><div class="bd" style="display:flex;gap:10px;align-items:center"><div class="av">{{ $claim->handler?->initials() ?? 'S' }}</div><div><b>{{ $claim->handler?->name ?? 'Suraksha claims desk' }}</b><div class="small muted">{{ $claim->handler?->designation }} · {{ $claim->handler?->phone }}</div></div></div></div>
    <div class="card mt"><div class="hd"><h2>What you reported</h2></div><div class="bd">
      <dl class="kv" style="grid-template-columns:110px 1fr"><dt>Date of loss</dt><dd>{{ $claim->loss_date->format('d M Y') }}</dd><dt>Location</dt><dd>{{ $claim->loss_location ?? '—' }}</dd><dt>Estimate</dt><dd>{{ $claim->estimated_amount ? inr($claim->estimated_amount) : '—' }}</dd>@if($claim->insurer_claim_no)<dt>Insurer claim no.</dt><dd>{{ $claim->insurer_claim_no }}</dd>@endif @if($claim->settled_amount)<dt>Settled</dt><dd><b class="up">{{ inr($claim->settled_amount) }}</b></dd>@endif</dl>
      <p class="small" style="margin-top:10px">{{ $claim->description }}</p>
      @if($claim->attachments)<div style="margin-top:10px">@foreach($claim->attachments as $i => $f)<div class="small"><a href="{{ route('portal.claim.file', [$claim, $i]) }}" target="_blank">📎 {{ $f['name'] }}</a></div>@endforeach</div>@endif
    </div></div>
  </div>
</div>
@endsection
