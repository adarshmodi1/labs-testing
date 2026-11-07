@extends('layouts.app')
@section('title', $posp->name)
@section('crumb', 'People · POSP agents')
@section('content')
<div class="ph"><div><h1>{{ $posp->name }}</h1><p>{{ $posp->code }} · {{ $posp->city }} · {{ $posp->phone }} · reports to {{ $posp->rm?->name ?? '—' }}</p></div><div class="sp"></div><span class="pill {{ stage_class($posp->status) }}">{{ $posp->status }}</span><a class="btn" href="{{ route('posps.edit', $posp) }}">Edit</a></div>
@php $steps = ['Applied', 'In training', 'Certified', 'Active']; $i = array_search($posp->status, $steps); @endphp
<div class="card mb"><div class="bd"><div class="steps">@foreach($steps as $k => $s)<div class="s {{ $i !== false && $k <= $i ? 'done' : '' }} {{ $i === $k ? 'cur' : '' }}">{{ $s }}</div>@endforeach</div></div></div>
<div class="grid g4 mb">
  <div class="kpi"><div class="l">Policies sold</div><div class="v">{{ $posp->policies->count() }}</div></div>
  <div class="kpi"><div class="l">Premium</div><div class="v">{{ inr_short($posp->policies->sum('premium')) }}</div></div>
  <div class="kpi"><div class="l">Training</div><div class="v">{{ $posp->training_hours }}/15 h</div><div class="s">Exam: {{ $posp->exam_status }}</div></div>
  <div class="kpi"><div class="l">Open leads</div><div class="v">{{ $posp->leads->whereNotIn('stage', ['Won', 'Lost'])->count() }}</div></div>
</div>
<div class="grid g-2-1">
  <div class="card"><div class="hd"><h2>Policies</h2></div><div class="bd flush"><table class="t">
    @forelse($posp->policies as $p)<tr><td>{{ $p->client->name }}<div class="sub">{{ $p->line }}</div></td><td>{{ $p->insurer->short_name }}</td><td>{{ $p->start_date->format('d M Y') }}</td><td class="num">{{ inr($p->premium) }}</td></tr>@empty<tr><td class="empty">No policies yet.</td></tr>@endforelse
  </table></div></div>
  <div class="card"><div class="hd"><h2>KYC &amp; certificate</h2></div><div class="bd"><dl class="kv" style="grid-template-columns:120px 1fr">
    <dt>PAN</dt><dd>{{ $posp->pan ?? '—' }}</dd><dt>Qualification</dt><dd>{{ $posp->qualification ?? '—' }}</dd>
    <dt>Bank</dt><dd>{{ $posp->bank_name }} @if($posp->account_last4)·· {{ $posp->account_last4 }}@endif</dd>
    <dt>Certificate</dt><dd>{{ $posp->certificate_no ?? '—' }}</dd><dt>Certified on</dt><dd>{{ $posp->certified_on?->format('d M Y') ?? '—' }}</dd>
    <dt>Can sell</dt><dd>@foreach(\App\Models\Posp::LINES as $l)<span class="tag">{{ $l }}</span>@endforeach</dd>
  </dl></div></div>
</div>
@endsection
