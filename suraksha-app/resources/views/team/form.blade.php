@extends('layouts.app')
@section('title', $user->exists ? 'Edit team member' : 'Add team member')
@section('crumb', 'People · Team')
@section('content')
<div class="ph"><div><h1>{{ $user->exists ? $user->name : 'Add team member' }}</h1></div></div>
<form method="post" action="{{ $user->exists ? route('team.update', $user) : route('team.store') }}" class="card">@csrf @if($user->exists) @method('put') @endif
  <div class="bd fg fg3">
    <div><label>Full name</label><input class="in" name="name" value="{{ old('name', $user->name) }}" required></div>
    <div><label>Work email</label><input class="in" type="email" name="email" value="{{ old('email', $user->email) }}" required></div>
    <div><label>Mobile</label><input class="in" name="phone" value="{{ old('phone', $user->phone) }}"></div>
    <div><label>Role</label><select class="in" name="role">@foreach(\App\Models\User::ROLES as $k => $v)<option value="{{ $k }}" @selected(old('role', $user->role) == $k)>{{ $v }}</option>@endforeach</select></div>
    <div><label>Designation</label><input class="in" name="designation" value="{{ old('designation', $user->designation) }}"></div>
    <div><label>Branch</label><input class="in" name="branch" value="{{ old('branch', $user->branch) }}" required></div>
    <div><label>Annual premium target (₹, for RMs)</label><input class="in" type="number" step="100000" name="annual_target" value="{{ old('annual_target', $user->annual_target + 0) }}"></div>
    <div><label>Joined on</label><input class="in" type="date" name="joined_on" value="{{ old('joined_on', $user->joined_on?->format('Y-m-d')) }}"></div>
    <div></div>
    <label class="check"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active ?? true))> Active</label>
    <label class="check"><input type="checkbox" name="can_login" value="1" @checked(old('can_login', $user->can_login))> Can log in</label>
    <div><label>Password {{ $user->exists ? '(leave blank to keep)' : '' }}</label><input class="in" type="password" name="password" autocomplete="new-password" placeholder="At least 8 characters"></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line);border-bottom:0"><div class="sp"></div><a class="btn" href="{{ route('team.index') }}">Cancel</a><button class="btn pri">Save</button></div>
</form>
@endsection
