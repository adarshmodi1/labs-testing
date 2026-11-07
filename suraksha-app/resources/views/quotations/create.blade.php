@extends('layouts.app')
@section('title', 'New quotation')
@section('crumb', 'Sales · Quotations')
@section('content')
<div class="ph"><div><h1>New quotation</h1><p>Set out the requirement, then collect quotes from insurers.</p></div></div>
<form method="post" action="{{ route('quotations.store') }}" class="card">@csrf
  <input type="hidden" name="lead_id" value="{{ $q->lead_id }}"><input type="hidden" name="renewal_id" value="{{ $q->renewal_id }}">
  <div class="bd fg fg3">
    @if($q->lead_id || $q->renewal_id)
      <div class="span2"><label>For</label><input class="in" name="prospect_name" value="{{ $q->prospect_name }}" readonly><input type="hidden" name="client_id" value="{{ $q->client_id }}"></div>
    @else
      <div class="span2"><label>Existing client</label>
        <select class="in" name="client_id" onchange="document.getElementById('pn').value = this.options[this.selectedIndex].text"><option value="">— or type a prospect name below —</option>@foreach($clients as $c)<option value="{{ $c->id }}" @selected($q->client_id == $c->id)>{{ $c->name }}</option>@endforeach</select>
        <input class="in" id="pn" name="prospect_name" value="{{ $q->prospect_name }}" placeholder="Prospect name" style="margin-top:8px" required></div>
    @endif
    <div><label>Relationship manager</label><select class="in" name="rm_id"><option value="">—</option>@foreach($rms as $u)<option value="{{ $u->id }}" @selected($q->rm_id == $u->id)>{{ $u->name }}</option>@endforeach</select></div>
    <div><label>Line of business</label><select class="in" name="line" required>@foreach($lines as $l)<option @selected($q->line == $l)>{{ $l }}</option>@endforeach</select></div>
    <div><label>Sum insured (₹)</label><input class="in" type="number" name="sum_insured" value="{{ $q->sum_insured ? (int) $q->sum_insured : '' }}"></div>
    <div><label>Expiring premium (₹, renewals)</label><input class="in" type="number" name="current_premium" value="{{ $q->current_premium ? (int) $q->current_premium : '' }}"></div>
    <div class="spanall"><label>Requirement</label><textarea class="in" name="requirement">{{ $q->requirement }}</textarea></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line);border-bottom:0"><div class="sp"></div><button class="btn pri">Create and add quotes</button></div>
</form>
@endsection
