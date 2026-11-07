@extends('layouts.app')
@section('title', 'CRM & leads')
@section('crumb', 'Sales · CRM & leads')
@section('content')
<div class="ph">
  <div><h1>CRM &amp; leads</h1><p>{{ $leads->whereNotIn('stage', ['Won', 'Lost'])->count() }} open leads · {{ inr_short($leads->whereNotIn('stage', ['Won', 'Lost'])->sum('expected_premium')) }} expected premium @if($overdue->count()) · <span class="down">{{ $overdue->count() }} follow-ups overdue</span>@endif</p></div>
  <div class="sp"></div>
  <div class="seg"><a href="{{ request()->fullUrlWithQuery(['view' => 'board']) }}" class="{{ $view === 'board' ? 'on' : '' }}">Board</a><a href="{{ request()->fullUrlWithQuery(['view' => 'list']) }}" class="{{ $view === 'list' ? 'on' : '' }}">List</a></div>
  <a class="btn pri" href="{{ route('leads.create') }}">+ New lead</a>
</div>
<form class="filters mb" method="get">
  <input type="hidden" name="view" value="{{ $view }}">
  <input class="in" name="q" value="{{ request('q') }}" placeholder="Search company, person, city">
  <select class="in" name="rm"><option value="">All RMs</option>@foreach($rms as $u)<option value="{{ $u->id }}" @selected(request('rm') == $u->id)>{{ $u->name }}</option>@endforeach</select>
  <select class="in" name="segment"><option value="">All segments</option>@foreach(\App\Models\Client::SEGMENTS as $s)<option @selected(request('segment') == $s)>{{ $s }}</option>@endforeach</select>
  <button class="btn">Filter</button>
  @if(request()->hasAny(['q', 'rm', 'segment']))<a class="btn ghost" href="{{ route('leads.index', ['view' => $view]) }}">Clear</a>@endif
</form>

@if($view === 'board')
<div class="kanban">
  @foreach(\App\Models\Lead::STAGES as $s)
    @php $col = $leads->where('stage', $s); @endphp
    <div class="col">
      <div class="ch"><span class="dot" style="background:{{ ['New' => '#9AA4AE', 'Contacted' => '#5B7DB1', 'Meeting' => '#E89B2E', 'Quotation' => '#1E4577', 'Won' => '#0E9F8E', 'Lost' => '#D1495B'][$s] }}"></span>{{ $s }}<span class="sp"></span><span class="muted">{{ $col->count() }} · {{ inr_short($col->sum('expected_premium')) }}</span></div>
      @foreach($col as $l)
        <a class="lc" href="{{ route('leads.show', $l) }}">
          <b>{{ $l->company }}</b>
          <div class="small muted">{{ $l->city }} · {{ $l->segment }}</div>
          <div style="margin-top:6px">@foreach(array_slice($l->linesArray(), 0, 2) as $ln)<span class="tag">{{ $ln }}</span>@endforeach @if(count($l->linesArray()) > 2)<span class="tag">+{{ count($l->linesArray()) - 2 }}</span>@endif</div>
          <div class="m"><span>{{ $l->rm?->name ?? '—' }}</span><b style="color:var(--navy)">{{ inr_short($l->expected_premium) }}</b></div>
          @if($l->next_follow_up && !in_array($l->stage, ['Won', 'Lost']))<div class="m"><span class="{{ $l->next_follow_up->isPast() ? 'down' : '' }}">Follow up {{ $l->next_follow_up->format('d M') }}</span>@if($l->posp)<span class="pill">POSP</span>@endif</div>@endif
        </a>
      @endforeach
    </div>
  @endforeach
</div>
@else
<div class="card"><div class="bd flush tablewrap">
<table class="t">
  <tr><th>Company</th><th>Lines</th><th>Source</th><th>Stage</th><th>RM</th><th>Next follow-up</th><th class="num">Expected premium</th></tr>
  @foreach($leads as $l)
  <tr>
    <td><a href="{{ route('leads.show', $l) }}"><b>{{ $l->company }}</b></a><div class="sub">{{ $l->contact_person }} · {{ $l->city }} · {{ $l->segment }}</div></td>
    <td>@foreach($l->linesArray() as $ln)<span class="tag">{{ $ln }}</span>@endforeach</td>
    <td>{{ $l->source }}@if($l->posp)<div class="sub">{{ $l->posp->name }}</div>@endif</td>
    <td><span class="pill {{ stage_class($l->stage) }}">{{ $l->stage }}</span></td>
    <td>{{ $l->rm?->name }}</td>
    <td class="{{ $l->next_follow_up && $l->next_follow_up->isPast() && !in_array($l->stage, ['Won', 'Lost']) ? 'down' : '' }}">{{ $l->next_follow_up?->format('d M Y') ?? '—' }}</td>
    <td class="num">{{ inr($l->expected_premium) }}</td>
  </tr>
  @endforeach
</table>
</div></div>
@endif
@endsection
