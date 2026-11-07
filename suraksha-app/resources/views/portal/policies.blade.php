@extends('layouts.portal')
@section('title', 'My policies')
@section('content')
<div class="ph"><div><h1>My policies</h1><p>{{ $all->count() }} active policies</p></div></div>
<div class="filters mb"><div class="seg"><a href="{{ route('portal.policies') }}" class="{{ !request('cat') ? 'on' : '' }}">All</a>@foreach($cats as $cat)<a href="{{ route('portal.policies', ['cat' => $cat]) }}" class="{{ request('cat') === $cat ? 'on' : '' }}">{{ $cat }}</a>@endforeach</div></div>
<div class="grid g3">
  @foreach($policies as $p)
  <a class="card" href="{{ route('portal.policy', $p) }}" style="text-decoration:none;color:inherit"><div class="bd">
    <div style="display:flex;justify-content:space-between;gap:8px"><span class="pill info">{{ $p->category() }}</span>@if($p->daysToExpiry() <= 60)<span class="pill {{ $p->daysToExpiry() <= 30 ? 'bad' : 'warn' }}">Renews in {{ days_label($p->daysToExpiry()) }}</span>@endif</div>
    <h2 style="margin-top:10px">{{ $p->line }}</h2>
    <div class="small muted" style="margin-top:2px"><span class="dot" style="background:{{ $p->insurer->colour }}"></span> {{ $p->insurer->short_name }} · {{ $p->policy_no }}</div>
    <div class="rowk" style="display:flex;justify-content:space-between;margin-top:12px;font-size:13px"><span class="muted">Sum insured</span><b>{{ inr_short($p->sum_insured) }}</b></div>
    <div style="display:flex;justify-content:space-between;font-size:13px;margin-top:4px"><span class="muted">Premium incl. GST</span><b>{{ inr($p->totalPremium()) }}</b></div>
    <div style="display:flex;justify-content:space-between;font-size:13px;margin-top:4px"><span class="muted">Valid till</span><b>{{ $p->end_date->format('d M Y') }}</b></div>
  </div></a>
  @endforeach
</div>
@endsection
