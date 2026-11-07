@extends('layouts.app')
@section('title', 'POSP agents')
@section('crumb', 'People · POSP agents')
@section('content')
<div class="ph"><div><h1>POSP agents</h1><p>Point-of-sale persons: onboarding, certification and the business they bring in. POSPs can sell only simple retail products (motor, health, PA, travel, home, term).</p></div><div class="sp"></div><a class="btn pri" href="{{ route('posps.create') }}">+ Add POSP</a></div>
<div class="stages mb">
  <a class="stg {{ !request('status') ? 'on' : '' }}" href="{{ route('posps.index') }}"><div class="n">{{ $counts->sum() }}</div><div class="l">All</div></a>
  @foreach(\App\Models\Posp::STATUSES as $s)<a class="stg {{ request('status') === $s ? 'on' : '' }}" href="{{ route('posps.index', ['status' => $s]) }}"><div class="n">{{ $counts[$s] ?? 0 }}</div><div class="l">{{ $s }}</div></a>@endforeach
</div>
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>POSP</th><th>City</th><th>Training</th><th>Certificate</th><th>RM</th><th class="num">Policies</th><th class="num">Premium</th><th>Status</th></tr>
  @foreach($posps as $p)
  <tr>
    <td><a href="{{ route('posps.show', $p) }}"><b>{{ $p->name }}</b></a><div class="sub">{{ $p->code }} · {{ $p->phone }}</div></td>
    <td>{{ $p->city }}</td>
    <td><div class="small">{{ $p->training_hours }}/15 hrs</div><div class="kpi" style="padding:0;border:0;box-shadow:none;background:transparent;width:90px"><div class="bar" style="margin:3px 0 0"><i style="width:{{ min(100, $p->training_hours / 15 * 100) }}%"></i></div></div></td>
    <td class="small">{{ $p->certificate_no ?? '—' }}@if($p->certified_on)<div class="sub">{{ $p->certified_on->format('d M Y') }}</div>@endif</td>
    <td>{{ $p->rm?->name }}</td>
    <td class="num">{{ $p->policies_count }}</td>
    <td class="num">{{ inr($p->policies_sum_premium ?? 0) }}</td>
    <td><span class="pill {{ stage_class($p->status) }}">{{ $p->status }}</span></td>
  </tr>
  @endforeach
</table></div></div>
@endsection
