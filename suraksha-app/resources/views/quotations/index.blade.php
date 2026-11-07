@extends('layouts.app')
@section('title', 'Quotations')
@section('crumb', 'Sales · Quotations')
@section('content')
<div class="ph">
  <div><h1>Quotations</h1><p>Insurer quotes collected for new business and renewals, compared side by side.</p></div>
  <div class="sp"></div>
  <a class="btn pri" href="{{ route('quotations.create') }}">+ New quotation</a>
</div>
<div class="stages mb">
  <a class="stg {{ !request('status') ? 'on' : '' }}" href="{{ route('quotations.index') }}"><div class="n">{{ $counts->sum() }}</div><div class="l">All</div></a>
  @foreach(\App\Models\Quotation::STATUSES as $s)
    <a class="stg {{ request('status') === $s ? 'on' : '' }}" href="{{ route('quotations.index', ['status' => $s]) }}"><div class="n">{{ $counts[$s] ?? 0 }}</div><div class="l">{{ $s }}</div></a>
  @endforeach
</div>
<div class="filters mb">
  <div class="seg"><a href="{{ request()->fullUrlWithQuery(['type' => null]) }}" class="{{ !request('type') ? 'on' : '' }}">All</a><a href="{{ request()->fullUrlWithQuery(['type' => 'renewal']) }}" class="{{ request('type') === 'renewal' ? 'on' : '' }}">Renewals</a><a href="{{ request()->fullUrlWithQuery(['type' => 'new']) }}" class="{{ request('type') === 'new' ? 'on' : '' }}">New business</a></div>
</div>
<div class="card"><div class="bd flush tablewrap">
<table class="t">
  <tr><th>Ref</th><th>Client / prospect</th><th>Line</th><th>Type</th><th>Quotes</th><th class="num">Best premium</th><th class="num">Expiring</th><th>Status</th><th>RM</th></tr>
  @forelse($quotes as $q)
  @php $best = $q->options->sortBy('premium')->first(); @endphp
  <tr>
    <td><a href="{{ route('quotations.show', $q) }}"><b>{{ $q->ref }}</b></a><div class="sub">{{ $q->created_at->format('d M Y') }}</div></td>
    <td>{{ $q->prospect_name }}</td>
    <td>{{ $q->line }}</td>
    <td>{{ $q->renewal_id ? 'Renewal' : 'New' }}</td>
    <td>@foreach($q->options as $o)<span class="dot" title="{{ $o->insurer->short_name }}" style="background:{{ $o->insurer->colour }};margin-right:3px"></span>@endforeach <span class="sub">{{ $q->options->count() }}</span></td>
    <td class="num">{{ $best ? inr($best->premium) : '—' }}@if($best)<div class="sub">{{ $best->insurer->short_name }}</div>@endif</td>
    <td class="num">{{ $q->current_premium ? inr($q->current_premium) : '—' }}</td>
    <td><span class="pill {{ stage_class($q->status) }}">{{ $q->status }}</span></td>
    <td>{{ $q->rm?->name }}</td>
  </tr>
  @empty <tr><td colspan="9" class="empty">No quotations here.</td></tr>
  @endforelse
</table>
</div></div>
@endsection
