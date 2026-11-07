@extends('layouts.app')
@section('title', $claim->ref)
@section('crumb', 'Book · Claims')
@section('content')
@php $flow = ['Requested', 'Intimated to insurer', 'Surveyor appointed', 'Documents pending', 'Under assessment', 'Settled']; $idx = array_search($claim->status, $flow); @endphp
<div class="ph">
  <div><h1>{{ $claim->ref }} · {{ $claim->loss_type }}</h1><p><a href="{{ route('clients.show', $claim->client) }}">{{ $claim->client->name }}</a> · <a href="{{ route('policies.show', $claim->policy) }}">{{ $claim->policy->line }}</a> · {{ $claim->policy->insurer->short_name }} · raised by {{ $claim->raised_by }} on {{ $claim->created_at->format('d M Y') }}</p></div>
  <div class="sp"></div><span class="pill {{ stage_class($claim->status) }}" style="font-size:13px;padding:5px 12px">{{ $claim->status }}</span>
</div>
<div class="card mb"><div class="bd">
  <div class="steps">@foreach($flow as $i => $s)<div class="s {{ $idx !== false && $i < $idx ? 'done' : '' }} {{ $idx === $i ? 'cur done' : '' }}">{{ $s }}</div>@endforeach</div>
  @if($claim->status === 'Repudiated')<div class="flash bad" style="margin:10px 0 0">Repudiated by the insurer.</div>@endif
</div></div>
<div class="grid g-2-1">
  <div>
    <div class="card"><div class="hd"><h2>Post an update</h2></div>
      <form method="post" action="{{ route('claims.update', $claim) }}" class="bd fg fg3">@csrf
        <div><label>Status</label><select class="in" name="status">@foreach(\App\Models\Claim::STATUSES as $s)<option @selected($claim->status === $s)>{{ $s }}</option>@endforeach</select></div>
        <div><label>Insurer claim no.</label><input class="in" name="insurer_claim_no" value="{{ $claim->insurer_claim_no }}"></div>
        <div><label>Handler</label><select class="in" name="handler_id">@foreach($handlers as $h)<option value="{{ $h->id }}" @selected($claim->handler_id == $h->id)>{{ $h->name }}</option>@endforeach</select></div>
        <div class="span2"><label>Update</label><input class="in" name="note" required placeholder="e.g. Surveyor visit fixed for Monday 11 am"></div>
        <div><label>Settled amount (₹)</label><input class="in" type="number" name="settled_amount" value="{{ $claim->settled_amount }}"></div>
        <label class="check spanall"><input type="checkbox" name="visible_to_client" value="1" checked> Show this update to the client in their portal</label>
        <div class="spanall"><button class="btn pri">Save update</button></div>
      </form>
    </div>
    <div class="card mt"><div class="hd"><h2>Timeline</h2></div><div class="bd"><div class="tl">
      @foreach($claim->updates as $u)
        <div class="it done"><b>{{ $u->status }}</b> <span class="small muted">· {{ $u->created_at->format('d M Y, g:i a') }} · {{ $u->user?->name ?? 'Client' }} @unless($u->visible_to_client)· <span class="pill">Internal</span>@endunless</span><div>{{ $u->note }}</div></div>
      @endforeach
    </div></div></div>
  </div>
  <div>
    <div class="card"><div class="hd"><h2>Loss details</h2></div><div class="bd">
      <dl class="kv" style="grid-template-columns:120px 1fr">
        <dt>Date of loss</dt><dd>{{ $claim->loss_date->format('d M Y') }}</dd><dt>Location</dt><dd>{{ $claim->loss_location ?? '—' }}</dd>
        <dt>Estimate</dt><dd>{{ inr($claim->estimated_amount) }}</dd><dt>Settled</dt><dd>{{ $claim->settled_amount ? inr($claim->settled_amount) : '—' }}</dd>
        <dt>Contact</dt><dd>{{ $claim->contact_name }}<div class="small muted">{{ $claim->contact_phone }}</div></dd>
        <dt>Policy no.</dt><dd>{{ $claim->policy->policy_no }}</dd><dt>Sum insured</dt><dd>{{ inr($claim->policy->sum_insured) }}</dd>
      </dl>
      <p style="margin-top:12px;background:#F7F9FB;padding:10px;border-radius:8px">{{ $claim->description }}</p>
      @if($claim->attachments)<h3 style="margin-top:14px">Attachments</h3>@foreach($claim->attachments as $i => $f)<div><a href="{{ route('files.claim', [$claim, $i]) }}" target="_blank">{{ $f['name'] }}</a></div>@endforeach @endif
    </div></div>
  </div>
</div>
@endsection
