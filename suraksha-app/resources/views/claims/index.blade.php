@extends('layouts.app')
@section('title', 'Claims')
@section('crumb', 'Book · Claims')
@section('content')
<div class="ph"><div><h1>Claims</h1><p>Claim requests from the client portal arrive here as “Requested”.</p></div></div>
<div class="stages mb">
  <a class="stg {{ !request('status') && !request('all') ? 'on' : '' }}" href="{{ route('claims.index') }}"><div class="n">{{ collect(\App\Models\Claim::OPEN)->sum(fn ($s) => $counts[$s] ?? 0) }}</div><div class="l">All open</div></a>
  @foreach(\App\Models\Claim::STATUSES as $s)
    <a class="stg {{ request('status') === $s ? 'on' : '' }}" href="{{ route('claims.index', ['status' => $s]) }}"><div class="n" style="{{ $s === 'Requested' && ($counts[$s] ?? 0) ? 'color:var(--gold)' : '' }}">{{ $counts[$s] ?? 0 }}</div><div class="l">{{ $s }}</div></a>
  @endforeach
</div>
<div class="card"><div class="bd flush tablewrap"><table class="t">
  <tr><th>Claim</th><th>Client · policy</th><th>Loss</th><th>Raised by</th><th class="num">Estimate</th><th class="num">Open for</th><th>Status</th><th>Handler</th></tr>
  @forelse($claims as $c)
  <tr>
    <td><a href="{{ route('claims.show', $c) }}"><b>{{ $c->ref }}</b></a>@if($c->insurer_claim_no)<div class="sub">{{ $c->insurer_claim_no }}</div>@endif</td>
    <td>{{ $c->client->name }}<div class="sub">{{ $c->policy->line }} · {{ $c->policy->insurer->short_name }}</div></td>
    <td>{{ $c->loss_type }}<div class="sub">{{ $c->loss_date->format('d M Y') }}</div></td>
    <td>{{ $c->raised_by }}</td>
    <td class="num">{{ inr($c->estimated_amount) }}@if($c->estimated_amount >= 1e7)<div><span class="pill gold">Senior-led</span></div>@endif</td>
    <td class="num">{{ days_label((int) $c->created_at->diffInDays(now())) }}</td>
    <td><span class="pill {{ $c->status === 'Requested' ? 'gold' : stage_class($c->status) }}">{{ $c->status }}</span></td>
    <td>{{ $c->handler?->name ?? '—' }}</td>
  </tr>
  @empty <tr><td colspan="8" class="empty">No claims here.</td></tr>
  @endforelse
</table></div></div>
<p class="small muted mt"><a href="{{ route('claims.index', ['all' => 1]) }}">Show all claims including settled and repudiated →</a></p>
@endsection
