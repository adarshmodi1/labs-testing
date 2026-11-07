@extends('layouts.app')
@section('title', $lead->exists ? 'Edit lead' : 'New lead')
@section('crumb', 'Sales · CRM & leads')
@section('content')
<div class="ph"><div><h1>{{ $lead->exists ? 'Edit ' . $lead->company : 'New lead' }}</h1><p>Capture who they are, what they need and who owns the next step.</p></div></div>
<form method="post" action="{{ $lead->exists ? route('leads.update', $lead) : route('leads.store') }}" class="card">
  @csrf @if($lead->exists) @method('put') @endif
  <div class="bd fg fg3">
    <div class="span2"><label>Company or person</label><input class="in" name="company" value="{{ old('company', $lead->company) }}" required></div>
    <div><label>Segment</label><select class="in" name="segment">@foreach(\App\Models\Client::SEGMENTS as $s)<option @selected(old('segment', $lead->segment) == $s)>{{ $s }}</option>@endforeach</select></div>
    <div><label>Contact person</label><input class="in" name="contact_person" value="{{ old('contact_person', $lead->contact_person) }}" required></div>
    <div><label>Phone</label><input class="in" name="phone" value="{{ old('phone', $lead->phone) }}" required></div>
    <div><label>Email</label><input class="in" type="email" name="email" value="{{ old('email', $lead->email) }}"></div>
    <div><label>City</label><input class="in" name="city" value="{{ old('city', $lead->city) }}" required></div>
    <div><label>Industry</label><input class="in" name="industry" value="{{ old('industry', $lead->industry) }}" placeholder="e.g. Steel, Tea export"></div>
    <div><label>Source</label><select class="in" name="source">@foreach(\App\Models\Lead::SOURCES as $s)<option @selected(old('source', $lead->source) == $s)>{{ $s }}</option>@endforeach</select></div>
    <div class="spanall"><label>Lines of business needed</label>
      @php $sel = old('lines', $lead->exists ? $lead->linesArray() : []); @endphp
      <div style="display:flex;flex-wrap:wrap;gap:6px 14px">
        @foreach($lines as $ln)<label class="check" style="font-weight:500;margin:0"><input type="checkbox" name="lines[]" value="{{ $ln }}" @checked(in_array($ln, $sel))> {{ $ln }}</label>@endforeach
      </div>
    </div>
    <div><label>Expected annual premium (₹)</label><input class="in" type="number" step="100" name="expected_premium" value="{{ old('expected_premium', $lead->expected_premium) }}"></div>
    <div><label>Stage</label><select class="in" name="stage">@foreach(\App\Models\Lead::STAGES as $s)<option @selected(old('stage', $lead->stage) == $s)>{{ $s }}</option>@endforeach</select></div>
    <div><label>Next follow-up</label><input class="in" type="date" name="next_follow_up" value="{{ old('next_follow_up', $lead->next_follow_up?->format('Y-m-d') ?? now()->addDays(2)->format('Y-m-d')) }}"></div>
    <div><label>Relationship manager</label><select class="in" name="rm_id"><option value="">—</option>@foreach($rms as $u)<option value="{{ $u->id }}" @selected(old('rm_id', $lead->rm_id) == $u->id)>{{ $u->name }}</option>@endforeach</select></div>
    <div><label>POSP agent (if sourced by one)</label><select class="in" name="posp_id"><option value="">—</option>@foreach($posps as $p)<option value="{{ $p->id }}" @selected(old('posp_id', $lead->posp_id) == $p->id)>{{ $p->name }} · {{ $p->code }}</option>@endforeach</select></div>
    <div class="spanall"><label>Notes</label><textarea class="in" name="notes">{{ old('notes', $lead->notes) }}</textarea></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line);border-bottom:0"><div class="sp"></div><a class="btn" href="{{ $lead->exists ? route('leads.show', $lead) : route('leads.index') }}">Cancel</a><button class="btn pri">Save lead</button></div>
</form>
@endsection
