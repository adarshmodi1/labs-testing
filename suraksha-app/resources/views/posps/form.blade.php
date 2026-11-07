@extends('layouts.app')
@section('title', $posp->exists ? 'Edit POSP' : 'Add POSP')
@section('crumb', 'People · POSP agents')
@section('content')
<div class="ph"><div><h1>{{ $posp->exists ? $posp->name : 'Add POSP agent' }}</h1><p>Onboarding needs KYC, Class 10 or above, 15 hours of training and a passed exam before certification.</p></div></div>
<form method="post" action="{{ $posp->exists ? route('posps.update', $posp) : route('posps.store') }}" class="card">@csrf @if($posp->exists) @method('put') @endif
  <div class="hd"><h2>Personal &amp; KYC</h2></div>
  <div class="bd fg fg3">
    <div><label>POSP code</label><input class="in" name="code" value="{{ old('code', $posp->code) }}" required></div>
    <div><label>Full name</label><input class="in" name="name" value="{{ old('name', $posp->name) }}" required></div>
    <div><label>Mobile</label><input class="in" name="phone" value="{{ old('phone', $posp->phone) }}" required></div>
    <div><label>Email</label><input class="in" type="email" name="email" value="{{ old('email', $posp->email) }}"></div>
    <div><label>PAN</label><input class="in" name="pan" value="{{ old('pan', $posp->pan) }}" placeholder="ABCDE1234F" style="text-transform:uppercase"></div>
    <div><label>City</label><input class="in" name="city" value="{{ old('city', $posp->city) }}" required></div>
    <div><label>Highest qualification</label><input class="in" name="qualification" value="{{ old('qualification', $posp->qualification) }}" placeholder="Class 10 minimum"></div>
    <div><label>Bank</label><input class="in" name="bank_name" value="{{ old('bank_name', $posp->bank_name) }}"></div>
    <div><label>Account no. (last 4 digits)</label><input class="in" name="account_last4" value="{{ old('account_last4', $posp->account_last4) }}" maxlength="4"></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line)"><h2>Training &amp; certification</h2></div>
  <div class="bd fg fg3">
    <div><label>Training hours completed</label><input class="in" type="number" name="training_hours" min="0" max="50" value="{{ old('training_hours', $posp->training_hours) }}"></div>
    <div><label>Exam</label><select class="in" name="exam_status">@foreach(['Not taken', 'Passed', 'Failed'] as $s)<option @selected(old('exam_status', $posp->exam_status) == $s)>{{ $s }}</option>@endforeach</select></div>
    <div><label>Status</label><select class="in" name="status">@foreach(\App\Models\Posp::STATUSES as $s)<option @selected(old('status', $posp->status) == $s)>{{ $s }}</option>@endforeach</select></div>
    <div><label>Certificate no.</label><input class="in" name="certificate_no" value="{{ old('certificate_no', $posp->certificate_no) }}"></div>
    <div><label>Certified on</label><input class="in" type="date" name="certified_on" value="{{ old('certified_on', $posp->certified_on?->format('Y-m-d')) }}"></div>
    <div><label>Reporting RM</label><select class="in" name="rm_id"><option value="">—</option>@foreach($rms as $u)<option value="{{ $u->id }}" @selected(old('rm_id', $posp->rm_id) == $u->id)>{{ $u->name }}</option>@endforeach</select></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line);border-bottom:0"><div class="sp"></div><a class="btn" href="{{ route('posps.index') }}">Cancel</a><button class="btn pri">Save</button></div>
</form>
@endsection
