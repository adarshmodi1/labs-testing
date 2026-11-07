<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') · Suraksha Platform</title>
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1">
@stack('head')
</head>
<body>
@php
  $r = request()->route()?->getName() ?? '';
  $on = fn ($p) => str_starts_with($r, $p) ? 'on' : '';
  $openRenewals = \App\Models\Renewal::whereIn('stage', \App\Models\Renewal::OPEN)->whereHas('policy', fn ($q) => $q->where('end_date', '<=', now()->addDays(90)))->count();
  $newClaims = \App\Models\Claim::where('status', 'Requested')->count();
@endphp
<div class="shell">
  <aside class="side">
    <div class="brand"><div class="mark">S</div><div><b>Suraksha</b><span>Operations platform</span></div></div>
    <nav class="nav">
      <a href="{{ route('dashboard') }}" class="{{ $on('dashboard') }}"><span class="ic">◧</span>Dashboard</a>
      <div class="grp">Sales</div>
      <a href="{{ route('leads.index') }}" class="{{ $on('leads') }}"><span class="ic">◎</span>CRM &amp; leads</a>
      <a href="{{ route('quotations.index') }}" class="{{ $on('quotations') }}"><span class="ic">⇆</span>Quotations</a>
      <a href="{{ route('renewals.index') }}" class="{{ $on('renewals') }}"><span class="ic">↻</span>Renewals<span class="cnt">{{ $openRenewals }}</span></a>
      <div class="grp">Book</div>
      <a href="{{ route('clients.index') }}" class="{{ $on('clients') }}"><span class="ic">▣</span>Clients</a>
      <a href="{{ route('policies.index') }}" class="{{ $on('policies') }}"><span class="ic">▤</span>Policies</a>
      <a href="{{ route('claims.index') }}" class="{{ $on('claims') }}"><span class="ic">✚</span>Claims @if($newClaims)<span class="cnt" style="background:var(--gold);color:var(--navy)">{{ $newClaims }} new</span>@endif</a>
      <div class="grp">People</div>
      <a href="{{ route('team.index') }}" class="{{ $on('team') }}"><span class="ic">◉</span>Team</a>
      <a href="{{ route('posps.index') }}" class="{{ $on('posps') }}"><span class="ic">◈</span>POSP agents</a>
      <div class="grp">System</div>
      <a href="{{ route('settings.edit') }}" class="{{ $on('settings') }}"><span class="ic">⚙</span>Settings</a>
      <a href="{{ route('portal.login') }}" target="_blank"><span class="ic">↗</span>Client portal</a>
    </nav>
    <div class="me">
      <div class="av gold">{{ auth()->user()->initials() }}</div>
      <div style="flex:1;min-width:0"><div style="color:#fff;font-weight:650">{{ auth()->user()->name }}</div><div>{{ auth()->user()->roleLabel() }}</div></div>
      <form method="post" action="{{ route('logout') }}">@csrf<button class="btn sm ghost" style="color:#C9D6E6" title="Log out">⏻</button></form>
    </div>
  </aside>
  <div class="main">
    <div class="top">
      <div class="crumb">@yield('crumb', 'Suraksha Insurance Brokers')</div>
      <div class="sp"></div>
      <span class="pill gold">Prototype · sample data</span>
      <span class="muted small">{{ now()->format('D, d M Y') }}</span>
    </div>
    <div class="content">
      @if(session('ok'))<div class="flash ok">{{ session('ok') }}</div>@endif
      @if(session('bad'))<div class="flash bad">{{ session('bad') }}</div>@endif
      @if($errors->any())<div class="flash bad">{{ $errors->first() }}</div>@endif
      @yield('content')
    </div>
  </div>
</div>
@stack('scripts')
</body>
</html>
