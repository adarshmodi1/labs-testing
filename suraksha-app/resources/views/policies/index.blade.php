@extends('layouts.app')
@section('title', 'Policies')
@section('crumb', 'Book · Policies')
@section('content')
<div class="ph"><div><h1>Policies</h1><p>{{ $policies->count() }} policies · {{ inr_short($policies->sum('premium')) }} premium · {{ inr_short($policies->sum(fn ($p) => $p->commission())) }} commission</p></div></div>
<form class="filters mb" method="get">
  <input class="in" name="q" value="{{ request('q') }}" placeholder="Search client or policy number">
  <select class="in" name="category"><option value="">All lines</option>@foreach($categories as $c)<option @selected(request('category') == $c)>{{ $c }}</option>@endforeach</select>
  <select class="in" name="insurer"><option value="">All insurers</option>@foreach($insurers as $i)<option value="{{ $i->id }}" @selected(request('insurer') == $i->id)>{{ $i->short_name }}</option>@endforeach</select>
  <select class="in" name="status">@foreach(['Active', 'Renewed', 'Lapsed'] as $s)<option @selected(request('status', 'Active') == $s)>{{ $s }}</option>@endforeach</select>
  <button class="btn">Filter</button>
</form>
<div class="card"><div class="bd flush tablewrap">
<table class="t">
  <tr><th>Client</th><th>Line</th><th>Insurer · policy no.</th><th>Period</th><th class="num">Sum insured</th><th class="num">Premium</th><th class="num">Commission</th><th>RM / POSP</th></tr>
  @foreach($policies as $p)
  <tr>
    <td><a href="{{ route('clients.show', $p->client) }}"><b>{{ $p->client->name }}</b></a><div class="sub">{{ $p->client->segment }}</div></td>
    <td><a href="{{ route('policies.show', $p) }}">{{ $p->line }}</a><div class="sub">{{ $p->category() }}</div></td>
    <td>{{ $p->insurer->short_name }}<div class="sub">{{ $p->policy_no }}</div></td>
    <td class="nowrap">{{ $p->start_date->format('d M y') }} – {{ $p->end_date->format('d M y') }}@if($p->status === 'Active' && $p->daysToExpiry() <= 90)<div class="sub down">{{ days_label($p->daysToExpiry(), ' left') }}</div>@endif</td>
    <td class="num">{{ inr_short($p->sum_insured) }}</td>
    <td class="num">{{ inr($p->premium) }}</td>
    <td class="num">{{ inr($p->commission()) }}<div class="sub">{{ $p->commission_rate + 0 }}%</div></td>
    <td>{{ $p->rm?->name }}@if($p->posp)<div class="sub">POSP {{ $p->posp->name }}</div>@endif</td>
  </tr>
  @endforeach
</table>
</div></div>
@endsection
