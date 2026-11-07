@extends('layouts.app')
@section('title', $lead->company)
@section('crumb', 'Sales · CRM & leads')
@section('content')
<div class="ph">
  <div><h1>{{ $lead->company }}</h1><p>{{ $lead->contact_person }} · {{ $lead->phone }} @if($lead->email) · {{ $lead->email }} @endif · {{ $lead->city }}</p></div>
  <div class="sp"></div>
  <span class="pill {{ stage_class($lead->stage) }}" style="font-size:13px;padding:5px 12px">{{ $lead->stage }}</span>
  <a class="btn" href="{{ route('leads.edit', $lead) }}">Edit</a>
  <a class="btn gold" href="{{ route('quotations.create', ['lead' => $lead->id]) }}">+ Start quotation</a>
</div>

<div class="card mb"><div class="bd">
  <form method="post" action="{{ route('leads.stage', $lead) }}" class="filters">@csrf
    <span class="small muted" style="font-weight:650">Move stage:</span>
    @foreach(\App\Models\Lead::STAGES as $s)
      @if($s !== 'Lost')<button class="btn sm {{ $lead->stage === $s ? 'pri' : '' }}" name="stage" value="{{ $s }}">{{ $s }}</button>@endif
    @endforeach
    <span style="flex:1"></span>
    <input class="in" name="lost_reason" placeholder="Reason if lost" style="min-width:220px">
    <button class="btn sm danger" name="stage" value="Lost">Mark lost</button>
  </form>
</div></div>

<div class="grid g-2-1">
  <div>
    <div class="card">
      <div class="hd"><h2>Activity</h2></div>
      <div class="bd">
        <form method="post" action="{{ route('leads.activity', $lead) }}" class="fg" style="grid-template-columns:140px 1fr 160px auto;align-items:end">@csrf
          <div><label>Type</label><select class="in" name="type">@foreach(['Call', 'Meeting', 'Email', 'WhatsApp', 'Note'] as $t)<option>{{ $t }}</option>@endforeach</select></div>
          <div><label>What happened</label><input class="in" name="note" required placeholder="e.g. Met CFO, received expiring policy"></div>
          <div><label>Next follow-up</label><input class="in" type="date" name="next_follow_up"></div>
          <button class="btn pri">Log</button>
        </form>
        <div class="tl mt2">
          @foreach($lead->activities as $a)
            <div class="it done"><b>{{ $a->type }}</b> <span class="small muted">· {{ $a->user?->name ?? 'System' }} · {{ $a->created_at->format('d M Y, g:i a') }}</span><div>{{ $a->note }}</div></div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="card mt">
      <div class="hd"><h2>Quotations</h2><div class="sp"></div><a class="btn sm" href="{{ route('quotations.create', ['lead' => $lead->id]) }}">+ New</a></div>
      <div class="bd flush">
        <table class="t">
          @forelse($lead->quotations as $q)
            <tr><td><a href="{{ route('quotations.show', $q) }}"><b>{{ $q->ref }}</b></a><div class="sub">{{ $q->line }}</div></td><td>{{ $q->options->count() }} quotes</td><td><span class="pill {{ stage_class($q->status) }}">{{ $q->status }}</span></td><td class="num">@if($q->options->count()) from {{ inr($q->options->min('premium')) }} @endif</td></tr>
          @empty <tr><td class="empty">No quotations yet.</td></tr>
          @endforelse
        </table>
      </div>
    </div>
  </div>
  <div>
    <div class="card"><div class="hd"><h2>Details</h2></div><div class="bd">
      <dl class="kv">
        <dt>Segment</dt><dd>{{ $lead->segment }}</dd>
        <dt>Industry</dt><dd>{{ $lead->industry ?? '—' }}</dd>
        <dt>Source</dt><dd>{{ $lead->source }}</dd>
        <dt>RM</dt><dd>{{ $lead->rm?->name ?? '—' }}</dd>
        <dt>POSP</dt><dd>{{ $lead->posp ? $lead->posp->name . ' (' . $lead->posp->code . ')' : '—' }}</dd>
        <dt>Expected premium</dt><dd>{{ inr($lead->expected_premium) }}</dd>
        <dt>Next follow-up</dt><dd class="{{ $lead->next_follow_up?->isPast() ? 'down' : '' }}">{{ $lead->next_follow_up?->format('d M Y') ?? '—' }}</dd>
        <dt>Lines</dt><dd>@foreach($lead->linesArray() as $ln)<span class="tag">{{ $ln }}</span>@endforeach</dd>
        @if($lead->lost_reason)<dt>Lost reason</dt><dd>{{ $lead->lost_reason }}</dd>@endif
      </dl>
      @if($lead->notes)<p class="small" style="margin-top:12px;background:#F7F9FB;padding:10px;border-radius:8px">{{ $lead->notes }}</p>@endif
    </div></div>
    <div class="card mt"><div class="bd">
      @if($lead->client)
        <p class="small">Converted to client <a href="{{ route('clients.show', $lead->client) }}"><b>{{ $lead->client->name }}</b></a>.</p>
      @else
        <h3>Won the business?</h3>
        <p class="small muted" style="margin:4px 0 10px">Create the client record from this lead. Contact details and quotations move across.</p>
        <form method="post" action="{{ route('leads.convert', $lead) }}">@csrf<button class="btn teal">Convert to client</button></form>
      @endif
    </div></div>
  </div>
</div>
@endsection
