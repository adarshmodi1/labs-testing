@extends('layouts.portal')
@section('title', 'Claims')
@section('content')
<div class="ph"><div><h1>Claims</h1><p>Report a claim and follow it stage by stage – no need to call for an update.</p></div><div class="sp"></div><a class="btn teal" href="{{ route('portal.claims.new') }}">Report a claim</a></div>
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>Claim</th><th>Policy</th><th>Date of loss</th><th class="num">Estimate</th><th>Status</th><th>Last update</th></tr>
  @forelse($claims as $cl)
  <tr><td><a href="{{ route('portal.claim', $cl) }}"><b>{{ $cl->ref }}</b></a><div class="sub">{{ $cl->loss_type }}</div></td><td>{{ $cl->policy->line }}<div class="sub">{{ $cl->policy->insurer->short_name }}</div></td><td>{{ $cl->loss_date->format('d M Y') }}</td><td class="num">{{ $cl->estimated_amount ? inr($cl->estimated_amount) : '—' }}</td><td><span class="pill {{ stage_class($cl->status) }}">{{ $cl->status }}</span></td><td class="sub">{{ $cl->updated_at->diffForHumans() }}</td></tr>
  @empty <tr><td colspan="6" class="empty">No claims yet.</td></tr>
  @endforelse
</table></div></div>
@endsection
