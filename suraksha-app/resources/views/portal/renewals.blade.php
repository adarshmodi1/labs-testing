@extends('layouts.portal')
@section('title', 'Renewals')
@section('content')
<div class="ph"><div><h1>Upcoming renewals</h1><p>Policies expiring in the next 120 days, and where each renewal stands.</p></div></div>
@php $clientStages = ['Not started' => 'Not started yet', 'Data requested' => 'Waiting for your details', 'Data received' => 'Collecting quotes from insurers', 'Quotes in' => 'Quotes ready for review', 'Client approved' => 'Approved – policy being issued']; @endphp
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>Policy</th><th>Current insurer</th><th>Expires</th><th class="num">Current premium</th><th>Status</th><th></th></tr>
  @forelse($rows as $p)
  @php $rn = $p->renewal; $q = $rn?->quotations->whereIn('status', ['Sent to client', 'Approved'])->sortByDesc('id')->first(); @endphp
  <tr>
    <td><a href="{{ route('portal.policy', $p) }}"><b>{{ $p->line }}</b></a><div class="sub">{{ $p->policy_no }}</div></td>
    <td>{{ $p->insurer->short_name }}</td>
    <td class="nowrap">{{ $p->end_date->format('d M Y') }}<div class="sub {{ $p->daysToExpiry() <= 30 ? 'down' : '' }}">{{ days_label($p->daysToExpiry()) }}</div></td>
    <td class="num">{{ inr($p->totalPremium()) }}</td>
    <td><span class="pill {{ stage_class($rn?->stage) }}">{{ $clientStages[$rn?->stage ?? 'Not started'] ?? $rn?->stage }}</span></td>
    <td>@if($q && $q->status === 'Sent to client')<a class="btn sm gold" href="{{ route('portal.quote', $q) }}">Compare &amp; approve</a>@elseif($q)<a class="btn sm" href="{{ route('portal.quote', $q) }}">View</a>@endif</td>
  </tr>
  @empty <tr><td colspan="6" class="empty">No renewals due in the next 120 days.</td></tr>
  @endforelse
</table></div></div>
@endsection
