@extends('layouts.app')
@section('title', 'Team')
@section('crumb', 'People · Team')
@section('content')
<div class="ph"><div><h1>Team</h1><p>{{ $users->where('is_active', true)->count() }} active members · {{ $users->where('can_login', true)->count() }} with login access</p></div><div class="sp"></div><a class="btn pri" href="{{ route('team.create') }}">+ Add team member</a></div>
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>Name</th><th>Role</th><th>Branch</th><th>Contact</th><th class="num">Clients</th><th class="num">Book</th><th class="num">Target</th><th>Login</th><th></th></tr>
  @foreach($users as $u)
  <tr style="{{ $u->is_active ? '' : 'opacity:.55' }}">
    <td><div style="display:flex;gap:10px;align-items:center"><div class="av">{{ $u->initials() }}</div><div><b>{{ $u->name }}</b><div class="sub">{{ $u->designation }}</div></div></div></td>
    <td><span class="pill {{ $u->role === 'admin' ? 'dark' : '' }}">{{ $u->roleLabel() }}</span></td>
    <td>{{ $u->branch }}</td>
    <td class="small">{{ $u->email }}<div class="sub">{{ $u->phone }}</div></td>
    <td class="num">{{ $u->clients_count ?: '—' }}</td>
    <td class="num">{{ $u->active_premium ? inr_short($u->active_premium) : '—' }}</td>
    <td class="num">{{ $u->annual_target > 0 ? inr_short($u->annual_target) : '—' }}</td>
    <td>@if(!$u->is_active)<span class="pill bad">Inactive</span>@elseif($u->can_login)<span class="pill ok">Can log in</span>@else<span class="pill">No login</span>@endif</td>
    <td><a class="btn sm" href="{{ route('team.edit', $u) }}">Edit</a></td>
  </tr>
  @endforeach
</table></div></div>
<p class="small muted mt">This prototype has one admin login. Team members can be given their own login later; role-based access (e.g. RMs seeing only their clients) is part of the full build.</p>
@endsection
