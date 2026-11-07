@extends('layouts.app')
@section('title', 'Clients')
@section('crumb', 'Book · Clients')
@section('content')
<div class="ph"><div><h1>Clients</h1><p>{{ $clients->count() }} clients, largest first</p></div></div>
<form class="filters mb" method="get">
  <input class="in" name="q" value="{{ request('q') }}" placeholder="Search name, city, industry">
  <select class="in" name="segment"><option value="">All segments</option>@foreach(\App\Models\Client::SEGMENTS as $s)<option @selected(request('segment') == $s)>{{ $s }}</option>@endforeach</select>
  <button class="btn">Filter</button>
</form>
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>Client</th><th>Segment</th><th>City</th><th>Contact</th><th>RM</th><th class="num">Active policies</th><th class="num">Premium</th></tr>
  @foreach($clients as $c)
  <tr>
    <td><a href="{{ route('clients.show', $c) }}"><b>{{ $c->name }}</b></a><div class="sub">{{ $c->industry }}@if($c->group_name) · {{ $c->group_name }}@endif</div></td>
    <td><span class="pill">{{ $c->segment }}</span></td>
    <td>{{ $c->city }}<div class="sub">{{ $c->state }}</div></td>
    <td>{{ $c->contact_person }}<div class="sub">{{ $c->phone }}</div></td>
    <td>{{ $c->rm?->name }}</td>
    <td class="num">{{ $c->active_count }}</td>
    <td class="num">{{ inr($c->active_premium ?? 0) }}</td>
  </tr>
  @endforeach
</table></div></div>
@endsection
