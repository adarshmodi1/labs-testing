@extends('layouts.app')
@section('title', $client->name)
@section('crumb', 'Book · Clients')
@section('content')
@php $active = $client->policies->where('status', 'Active'); @endphp
<div class="ph">
  <div><h1>{{ $client->name }}</h1><p>{{ $client->industry ?? $client->segment }} · {{ $client->city }}, {{ $client->state }} @if($client->gstin) · GSTIN {{ $client->gstin }} @endif @if($client->group_name) · {{ $client->group_name }}@endif</p></div>
  <div class="sp"></div>
  <a class="btn" href="{{ route('quotations.create', ['client' => $client->id]) }}">+ Quotation</a>
</div>
<div class="grid g4 mb">
  <div class="kpi dark"><div class="l">Active premium</div><div class="v">{{ inr_short($active->sum('premium')) }}</div><div class="s">{{ $active->count() }} policies</div></div>
  <div class="kpi"><div class="l">Commission</div><div class="v">{{ inr_short($active->sum(fn ($p) => $p->commission())) }}</div></div>
  <div class="kpi"><div class="l">Next expiry</div><div class="v" style="font-size:20px">{{ $active->sortBy('end_date')->first()?->end_date->format('d M Y') ?? '—' }}</div><div class="s">{{ $active->sortBy('end_date')->first()?->line }}</div></div>
  <div class="kpi"><div class="l">Open claims</div><div class="v">{{ $client->claims->whereIn('status', \App\Models\Claim::OPEN)->count() }}</div><div class="s">Client since {{ $client->client_since?->format('Y') ?? '—' }}</div></div>
</div>
<div class="grid g-2-1">
  <div>
    <div class="card"><div class="hd"><h2>Policies</h2></div><div class="bd flush tablewrap"><table class="t">
      <tr><th>Line</th><th>Insurer</th><th>Period</th><th class="num">Premium</th><th>Status</th></tr>
      @foreach($client->policies as $p)
      <tr><td><a href="{{ route('policies.show', $p) }}"><b>{{ $p->line }}</b></a><div class="sub">{{ $p->policy_no }}</div></td><td>{{ $p->insurer->short_name }}</td><td class="nowrap">{{ $p->start_date->format('d M y') }} – {{ $p->end_date->format('d M y') }}</td><td class="num">{{ inr($p->premium) }}</td>
        <td><span class="pill {{ stage_class($p->status) }}">{{ $p->status }}</span>@if($p->renewal && in_array($p->renewal->stage, \App\Models\Renewal::OPEN))<div class="sub">Renewal: {{ $p->renewal->stage }}</div>@endif</td></tr>
      @endforeach
    </table></div></div>
    <div class="grid g2 mt">
      <div class="card"><div class="hd"><h2>Quotations</h2></div><div class="bd flush"><table class="t">
        @forelse($client->quotations as $q)<tr><td><a href="{{ route('quotations.show', $q) }}">{{ $q->ref }}</a><div class="sub">{{ $q->line }}</div></td><td><span class="pill {{ stage_class($q->status) }}">{{ $q->status }}</span></td></tr>@empty<tr><td class="empty">None</td></tr>@endforelse
      </table></div></div>
      <div class="card"><div class="hd"><h2>Claims</h2></div><div class="bd flush"><table class="t">
        @forelse($client->claims as $c)<tr><td><a href="{{ route('claims.show', $c) }}">{{ $c->ref }}</a><div class="sub">{{ $c->loss_type }} · {{ $c->policy->line }}</div></td><td><span class="pill {{ stage_class($c->status) }}">{{ $c->status }}</span></td></tr>@empty<tr><td class="empty">None</td></tr>@endforelse
      </table></div></div>
    </div>
  </div>
  <div>
    <div class="card"><div class="hd"><h2>Contact</h2></div><div class="bd"><dl class="kv" style="grid-template-columns:110px 1fr">
      <dt>Person</dt><dd>{{ $client->contact_person }}@if($client->contact_designation)<div class="small muted">{{ $client->contact_designation }}</div>@endif</dd>
      <dt>Phone</dt><dd>{{ $client->phone }}</dd><dt>Email</dt><dd>{{ $client->email }}</dd>
      <dt>RM</dt><dd>{{ $client->rm?->name }}</dd>@if($client->posp)<dt>POSP</dt><dd>{{ $client->posp->name }}</dd>@endif
    </dl></div></div>
    <div class="card mt"><div class="hd"><h2>Client portal access</h2></div><div class="bd">
      @foreach($client->portalUsers as $u)<div style="display:flex;gap:8px;align-items:center;margin-bottom:8px"><div class="av">{{ mb_substr($u->name, 0, 1) }}</div><div><b>{{ $u->name }}</b><div class="small muted">{{ $u->email }} · {{ $u->last_login_at ? 'last login ' . $u->last_login_at->diffForHumans() : 'not logged in yet' }}</div></div></div>@endforeach
      <form method="post" action="{{ route('clients.portal-user', $client) }}" class="fg" style="margin-top:8px">@csrf
        <div><label>Name</label><input class="in" name="name" value="{{ $client->contact_person }}" required></div>
        <div><label>Email</label><input class="in" type="email" name="email" value="{{ $client->portalUsers->isEmpty() ? $client->email : '' }}" required></div>
        <button class="btn">Create portal login</button>
      </form>
    </div></div>
  </div>
</div>
@endsection
