@extends('layouts.portal')
@section('title', 'Quotes')
@section('content')
<div class="ph"><div><h1>Quotes</h1><p>Comparisons Suraksha has prepared for you.</p></div></div>
<div class="card"><div class="bd flush"><table class="t">
  <tr><th>Quote</th><th>For</th><th>Options</th><th>Sent</th><th>Status</th><th></th></tr>
  @forelse($quotes as $q)
  <tr><td><b>{{ $q->ref }}</b></td><td>{{ $q->line }}<div class="sub">{{ $q->renewal_id ? 'Renewal' : 'New cover' }}</div></td><td>{{ $q->options->where('show_to_client', true)->count() }} insurers</td><td>{{ $q->sent_at?->format('d M Y') }}</td>
    <td><span class="pill {{ $q->status === 'Sent to client' ? 'gold' : stage_class($q->status) }}">{{ $q->status === 'Sent to client' ? 'Awaiting your approval' : $q->status }}</span>@if($q->approvedOption)<div class="sub">{{ $q->approvedOption->insurer->short_name }}</div>@endif</td>
    <td><a class="btn sm {{ $q->status === 'Sent to client' ? 'gold' : '' }}" href="{{ route('portal.quote', $q) }}">{{ $q->status === 'Sent to client' ? 'Compare & approve' : 'View' }}</a></td></tr>
  @empty <tr><td colspan="6" class="empty">No quotes yet.</td></tr>
  @endforelse
</table></div></div>
@endsection
