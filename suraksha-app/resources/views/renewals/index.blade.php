@extends('layouts.app')
@section('title', 'Renewals')
@section('crumb', 'Sales · Renewals')
@section('content')
<div class="ph">
  <div><h1>Renewals</h1><p>{{ $all->count() }} open renewals expiring in {{ $due }} days · {{ inr_short($all->sum(fn ($x) => (float) $x->policy->premium)) }} premium · <span class="down">{{ $all->filter->isAtRisk()->count() }} at risk</span></p></div>
  <div class="sp"></div>
  <div class="seg">@foreach([15, 30, 60, 90, 120] as $d)<a href="{{ request()->fullUrlWithQuery(['due' => $d]) }}" class="{{ $due == $d ? 'on' : '' }}">{{ $d }} days</a>@endforeach</div>
</div>
<div class="stages mb">
  @foreach($stageCounts as $s => $c)
    <a class="stg {{ request('stage') === $s ? 'on' : '' }}" href="{{ request()->fullUrlWithQuery(['stage' => request('stage') === $s ? null : $s]) }}"><div class="n">{{ $c['n'] }}</div><div class="l">{{ $s }}</div><div class="p">{{ inr_short($c['p']) }}</div></a>
  @endforeach
</div>
<form class="filters mb" method="get">
  <input type="hidden" name="due" value="{{ $due }}">@if(request('stage'))<input type="hidden" name="stage" value="{{ request('stage') }}">@endif
  <select class="in" name="owner"><option value="">All RMs</option>@foreach($owners as $u)<option value="{{ $u->id }}" @selected(request('owner') == $u->id)>{{ $u->name }}</option>@endforeach</select>
  <select class="in" name="line"><option value="">All lines</option>@foreach($categories as $c)<option @selected(request('line') == $c)>{{ $c }}</option>@endforeach</select>
  <label class="check" style="margin:0"><input type="checkbox" name="risk" value="1" @checked(request('risk'))> At risk only</label>
  <button class="btn">Filter</button>
  @if(request()->hasAny(['owner', 'line', 'risk', 'stage']))<a class="btn ghost" href="{{ route('renewals.index', ['due' => $due]) }}">Clear</a>@endif
</form>
<div class="card"><div class="bd flush tablewrap">
<table class="t">
  <tr><th>Client · policy</th><th>Insurer</th><th>Expires</th><th class="num">Premium</th><th>Owner</th><th>Stage</th><th>Next step</th><th style="width:260px">Update</th></tr>
  @forelse($list as $rw)
  @php $p = $rw->policy; $d = $p->daysToExpiry(); $q = $rw->quotations->sortByDesc('id')->first(); @endphp
  <tr>
    <td><a href="{{ route('clients.show', $p->client) }}"><b>{{ $p->client->name }}</b></a><div class="sub"><a href="{{ route('policies.show', $p) }}">{{ $p->line }}</a> · {{ $p->policy_no }}</div></td>
    <td>{{ $p->insurer->short_name }}</td>
    <td class="nowrap"><b class="{{ $d <= 15 ? 'down' : '' }}">{{ days_label($d) }}</b><div class="sub">{{ $p->end_date->format('d M Y') }}</div></td>
    <td class="num">{{ inr($p->premium) }}</td>
    <td>{{ $rw->owner?->name }}</td>
    <td><span class="pill {{ stage_class($rw->stage) }}">{{ $rw->stage }}</span>@if($rw->isAtRisk())<div style="margin-top:4px"><span class="pill bad">At risk</span></div>@endif</td>
    <td class="small" style="max-width:220px">{{ $rw->notes ?? '—' }}
      <div style="margin-top:4px">@if($q)<a href="{{ route('quotations.show', $q) }}">{{ $q->ref }} · {{ $q->status }}</a>@else<a href="{{ route('quotations.create', ['renewal' => $rw->id]) }}">+ Start renewal quote</a>@endif</div></td>
    <td>
      <form method="post" action="{{ route('renewals.stage', $rw) }}" style="display:flex;gap:6px;flex-wrap:wrap">@csrf
        <select class="in" name="stage" style="padding:5px 8px;font-size:12px;width:auto" onchange="this.form.querySelector('.lr').style.display = this.value === 'Lost' ? 'block' : 'none'">@foreach(\App\Models\Renewal::STAGES as $s)<option @selected($rw->stage === $s)>{{ $s }}</option>@endforeach</select>
        <button class="btn sm">Save</button>
        <input class="in lr" name="lost_reason" placeholder="Reason lost" style="display:none;padding:5px 8px;font-size:12px">
      </form>
    </td>
  </tr>
  @empty <tr><td colspan="8" class="empty">No renewals match.</td></tr>
  @endforelse
</table>
</div></div>
<div class="card mt"><div class="hd"><h2>Recently closed</h2></div><div class="bd flush"><table class="t">
  @foreach($recent as $rw)<tr><td>{{ $rw->policy->client->name }}<div class="sub">{{ $rw->policy->line }}</div></td><td><span class="pill {{ stage_class($rw->stage) }}">{{ $rw->stage }}</span></td><td class="small">{{ $rw->stage === 'Lost' ? $rw->lost_reason : 'Renewed at ' . inr($rw->renewed_premium) . ' (was ' . inr($rw->policy->premium) . ')' }}</td><td class="sub">{{ $rw->updated_at->format('d M Y') }}</td></tr>@endforeach
</table></div></div>
@endsection
