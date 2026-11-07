@extends('layouts.portal')
@section('title', 'Report a claim')
@section('content')
<p class="small"><a href="{{ route('portal.claims') }}">← Claims</a></p>
<div class="ph"><div><h1>Report a claim</h1><p>Tell us what happened. You don’t need every document now – add what you have and our claims team will guide you.</p></div></div>
<form method="post" action="{{ route('portal.claims.store') }}" enctype="multipart/form-data" class="card">@csrf
  <div class="bd fg fg2">
    <div class="span2"><label>Which policy?</label><select class="in" name="policy_id" required><option value="">Choose a policy…</option>@foreach($policies as $p)<option value="{{ $p->id }}" @selected(old('policy_id', $selected) == $p->id)>{{ $p->line }} · {{ $p->insurer->short_name }} · {{ $p->policy_no }}</option>@endforeach</select></div>
    <div><label>Date of loss</label><input class="in" type="date" name="loss_date" max="{{ now()->format('Y-m-d') }}" value="{{ old('loss_date', now()->format('Y-m-d')) }}" required></div>
    <div><label>What kind of loss?</label><select class="in" name="loss_type" required>@foreach(\App\Models\Claim::LOSS_TYPES as $t)<option @selected(old('loss_type') == $t)>{{ $t }}</option>@endforeach</select></div>
    <div class="span2"><label>Where did it happen?</label><input class="in" name="loss_location" value="{{ old('loss_location') }}" placeholder="e.g. Unit 2 warehouse, Dasnagar, Howrah"></div>
    <div class="span2"><label>What happened?</label><textarea class="in" name="description" required placeholder="Describe the incident, what was damaged and any immediate steps taken.">{{ old('description') }}</textarea></div>
    <div><label>Rough estimate of loss (₹, optional)</label><input class="in" type="number" name="estimated_amount" value="{{ old('estimated_amount') }}"></div>
    <div></div>
    <div><label>Contact person for the surveyor</label><input class="in" name="contact_name" value="{{ old('contact_name', auth('customer')->user()->name) }}" required></div>
    <div><label>Contact phone</label><input class="in" name="contact_phone" value="{{ old('contact_phone', $c->phone) }}" required></div>
    <div class="span2"><label>Photos and documents (up to 6 · JPG, PNG or PDF)</label><input class="in" type="file" name="files[]" multiple accept="image/*,application/pdf"><div class="hint">Photos of the damage, FIR (for theft or accident), invoices – whatever you have now.</div></div>
  </div>
  <div class="hd" style="border-top:1px solid var(--line);border-bottom:0"><span class="small muted">Your Suraksha claims team is notified as soon as you submit.</span><div class="sp"></div><button class="btn teal">Submit claim request</button></div>
</form>
@endsection
