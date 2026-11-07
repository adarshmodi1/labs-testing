<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Home') · Suraksha client portal</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">
</head>
<body>
@php $r = request()->route()?->getName() ?? ''; $on = fn ($p) => $r === $p || str_starts_with($r, $p . '.') ? 'on' : ''; $u = auth('customer')->user(); @endphp
<header class="ptop"><div class="in-wrap">
  <div class="brand" style="padding:0;border:0"><div class="mark">S</div><div><b style="color:var(--navy)">Suraksha</b><span style="color:var(--muted)">Client portal</span></div></div>
  <nav>
    <a href="{{ route('portal.home') }}" class="{{ $on('portal.home') }}">Overview</a>
    <a href="{{ route('portal.policies') }}" class="{{ $on('portal.policies') || $on('portal.policy') ? 'on' : '' }}">My policies</a>
    <a href="{{ route('portal.renewals') }}" class="{{ $on('portal.renewals') }}">Renewals</a>
    <a href="{{ route('portal.quotes') }}" class="{{ $on('portal.quotes') || $on('portal.quote') ? 'on' : '' }}">Quotes</a>
    <a href="{{ route('portal.claims') }}" class="{{ $on('portal.claims') || $on('portal.claim') ? 'on' : '' }}">Claims</a>
  </nav>
  <div style="flex:1"></div>
  <div style="text-align:right" class="small"><b>{{ $u->name }}</b><div class="muted">{{ $u->client->name }}</div></div>
  <form method="post" action="{{ route('portal.logout') }}">@csrf<button class="btn sm">Log out</button></form>
</div></header>
<main class="pcontent">
  @if(session('ok'))<div class="flash ok">{{ session('ok') }}</div>@endif
  @if($errors->any())<div class="flash bad">{{ $errors->first() }}</div>@endif
  @yield('content')
  <p class="small muted" style="margin-top:36px;text-align:center">Suraksha Insurance Brokers Pvt Ltd · IRDAI direct broker licence 177 · Your relationship manager: {{ $u->client->rm?->name }} ({{ $u->client->rm?->phone }})</p>
</main>
</body></html>
