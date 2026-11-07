@extends('layouts.app')
@section('title', 'Dashboard')
@section('crumb', 'Business dashboard')
@section('content')
<div class="ph">
  <div><h1>Business at a glance</h1><p>{{ fy_label() }} to date · all branches · figures are net premium before GST</p></div>
  <div class="sp"></div>
  <a class="btn" href="{{ route('renewals.index', ['due' => 30]) }}">Renewals due in 30 days</a>
  <a class="btn pri" href="{{ route('leads.create') }}">+ New lead</a>
</div>

<div class="grid g4">
  <div class="kpi dark">
    <div class="l">Premium written · {{ fy_label() }}</div>
    <div class="v">{{ inr_short($gwp) }}</div>
    <div class="s">@if($growth !== null)<span style="color:{{ $growth >= 0 ? '#7FE0CF' : '#FFB3BE' }};font-weight:700">{{ $growth >= 0 ? '▲' : '▼' }} {{ abs($growth) }}%</span> vs same period last year @endif</div>
  </div>
  <div class="kpi">
    <div class="l">Commission earned · {{ fy_label() }}</div>
    <div class="v">{{ inr_short($commission) }}</div>
    <div class="s">Average {{ $gwp ? round($commission / $gwp * 100, 1) : 0 }}% of premium</div>
  </div>
  <div class="kpi">
    <div class="l">Policies in force</div>
    <div class="v">{{ number_format($inForce) }}</div>
    <div class="s">{{ inr_short($inForcePremium) }} premium · {{ $activeClients }} active clients</div>
  </div>
  <div class="kpi gold">
    <div class="l">Renewal retention · last 12 months</div>
    <div class="v">{{ $retention !== null ? $retention . '%' : '—' }}</div>
    <div class="s">{{ $closed->where('stage', 'Renewed')->count() }} renewed · {{ $closed->where('stage', 'Lost')->count() }} lost</div>
    <div class="bar"><i style="width:{{ $retention ?? 0 }}%;background:var(--gold)"></i></div>
  </div>
</div>

<div class="grid g4 mt">
  <a class="kpi" href="{{ route('renewals.index', ['due' => 90]) }}" style="text-decoration:none">
    <div class="l">Renewals due · next 90 days</div>
    <div class="v">{{ $due90->count() }}</div>
    <div class="s">{{ inr_short($due90->sum(fn ($r) => (float) $r->policy->premium)) }} premium at stake · {{ $due30->count() }} in 30 days</div>
  </a>
  <a class="kpi" href="{{ route('renewals.index', ['risk' => 1]) }}" style="text-decoration:none">
    <div class="l">Renewals at risk</div>
    <div class="v" style="color:var(--red)">{{ $atRisk->count() }}</div>
    <div class="s">Behind schedule for days left · {{ inr_short($atRisk->sum(fn ($r) => (float) $r->policy->premium)) }}</div>
  </a>
  <a class="kpi" href="{{ route('leads.index') }}" style="text-decoration:none">
    <div class="l">Sales pipeline · open leads</div>
    <div class="v">{{ inr_short($openLeads->sum('expected_premium')) }}</div>
    <div class="s">{{ $openLeads->count() }} leads · win rate {{ $conversion ?? '—' }}%</div>
  </a>
  <a class="kpi" href="{{ route('claims.index') }}" style="text-decoration:none">
    <div class="l">Open claims</div>
    <div class="v">{{ $openClaims->count() }}</div>
    <div class="s">{{ inr_short($openClaims->sum('estimated_amount')) }} estimated · {{ $newClaimRequests->count() }} new requests · {{ $awaitingClient }} quotes with clients</div>
  </a>
</div>

<div class="grid g-2-1 mt">
  <div class="card">
    <div class="hd"><h2>Premium written by month</h2><span class="muted small">₹ lakh, last 12 months</span></div>
    <div class="bd"><canvas id="monthly" height="110"></canvas></div>
  </div>
  <div class="card">
    <div class="hd"><h2>Renewal pipeline · next 90 days</h2></div>
    <div class="bd">
      @php $maxS = max(1, $stageCounts->max()); @endphp
      <div class="bars">
      @foreach($stageCounts as $s => $n)
        <div class="row"><a href="{{ route('renewals.index', ['stage' => $s]) }}">{{ $s }}</a><div class="track"><i style="width:{{ $n / $maxS * 100 }}%;background:{{ ['Not started' => '#9AA4AE', 'Data requested' => '#E89B2E', 'Data received' => '#C8A862', 'Quotes in' => '#1E4577', 'Client approved' => '#0E9F8E'][$s] }}"></i></div><span class="num"><b>{{ $n }}</b></span></div>
      @endforeach
      </div>
      <p class="small muted" style="margin-top:8px">Renewals start 90 days before expiry. A renewal is “at risk” when its stage is behind for the days left.</p>
    </div>
  </div>
</div>

<div class="grid g3 mt">
  <div class="card"><div class="hd"><h2>Premium by line of business</h2></div><div class="bd"><canvas id="cat" height="220"></canvas></div></div>
  <div class="card"><div class="hd"><h2>Premium by insurer</h2></div><div class="bd"><canvas id="ins" height="220"></canvas></div></div>
  <div class="card"><div class="hd"><h2>Premium by client segment</h2></div><div class="bd"><canvas id="seg" height="220"></canvas></div></div>
</div>

<div class="card mt">
  <div class="hd"><h2>Relationship managers</h2><span class="muted small">Target vs premium written in {{ fy_label() }} · {{ $rms->first()?->pace }}% of the year gone</span></div>
  <div class="bd flush tablewrap">
    <table class="t">
      <tr><th>RM</th><th class="num">Annual target</th><th class="num">Written</th><th style="width:22%">Progress</th><th class="num">Renewals (90d)</th><th class="num">At risk</th><th class="num">Open leads</th><th class="num">Pipeline</th></tr>
      @foreach($rms as $x)
      <tr>
        <td><b>{{ $x->user->name }}</b><div class="sub">{{ $x->user->designation }}</div></td>
        <td class="num">{{ inr_short($x->target) }}</td>
        <td class="num">{{ inr_short($x->achieved) }}</td>
        <td><div style="display:flex;align-items:center;gap:8px"><div class="kpi" style="padding:0;border:0;box-shadow:none;flex:1;background:transparent"><div class="bar" style="margin:0;position:relative"><i style="width:{{ min(100, $x->pct) }}%;background:{{ $x->pct >= $x->pace ? 'var(--teal)' : 'var(--amber)' }}"></i></div></div><b class="small">{{ $x->pct }}%</b></div></td>
        <td class="num">{{ $x->renewals }}</td>
        <td class="num">@if($x->atRisk)<span class="pill bad">{{ $x->atRisk }}</span>@else 0 @endif</td>
        <td class="num">{{ $x->leads }}</td>
        <td class="num">{{ inr_short($x->pipeline) }}</td>
      </tr>
      @endforeach
    </table>
  </div>
</div>

<div class="grid g2 mt">
  <div class="card">
    <div class="hd"><h2>Expiring in the next 15 days</h2><div class="sp"></div><a class="small" href="{{ route('renewals.index', ['due' => 15]) }}">All →</a></div>
    <div class="bd flush tablewrap">
      <table class="t">
        <tr><th>Client · line</th><th>Expires</th><th>Stage</th><th class="num">Premium</th></tr>
        @forelse($next15 as $rw)
        <tr>
          <td><a href="{{ route('clients.show', $rw->policy->client) }}"><b>{{ $rw->policy->client->name }}</b></a><div class="sub">{{ $rw->policy->line }} · {{ $rw->policy->insurer->short_name }}</div></td>
          <td class="nowrap">{{ $rw->policy->end_date->format('d M') }}<div class="sub">{{ days_label($rw->policy->daysToExpiry()) }}</div></td>
          <td><span class="pill {{ $rw->isAtRisk() ? 'bad' : stage_class($rw->stage) }}">{{ $rw->stage }}</span></td>
          <td class="num">{{ inr($rw->policy->premium) }}</td>
        </tr>
        @empty <tr><td colspan="4" class="empty">Nothing expiring in 15 days.</td></tr>
        @endforelse
      </table>
    </div>
  </div>
  <div class="card">
    <div class="hd"><h2>New claim requests from clients</h2><div class="sp"></div><a class="small" href="{{ route('claims.index', ['status' => 'Requested']) }}">All →</a></div>
    <div class="bd flush tablewrap">
      <table class="t">
        <tr><th>Claim</th><th>Loss</th><th class="num">Estimate</th></tr>
        @forelse($newClaimRequests->take(6) as $c)
        <tr>
          <td><a href="{{ route('claims.show', $c) }}"><b>{{ $c->ref }}</b></a> · {{ $c->client->name }}<div class="sub">{{ $c->policy->line }}</div></td>
          <td>{{ $c->loss_type }}<div class="sub">{{ $c->loss_date->format('d M Y') }}</div></td>
          <td class="num">{{ inr($c->estimated_amount) }}</td>
        </tr>
        @empty <tr><td colspan="3" class="empty">No new requests.</td></tr>
        @endforelse
      </table>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.js') }}"></script>
<script>
Chart.defaults.font.family = 'Inter, system-ui, sans-serif';
Chart.defaults.color = '#5D6B78';
const pal = ['#0B2545','#1E4577','#C8A862','#0E9F8E','#E89B2E','#5B7DB1','#9AA4AE','#D1495B','#7A5F1F','#3D2C8D','#2E7D32','#B5121B'];
const lakh = v => '₹' + (v >= 100 ? (v/100).toFixed(2) + ' Cr' : v.toFixed(1) + ' L');
new Chart(document.getElementById('monthly'), {type:'bar', data:{labels:@json($monthly->pluck('label')), datasets:[{data:@json($monthly->pluck('value')), backgroundColor:'#1E4577', borderRadius:4}]},
  options:{plugins:{legend:{display:false}, tooltip:{callbacks:{label:c => lakh(c.raw)}}}, scales:{y:{grid:{color:'#EEF1F4'}, ticks:{callback:v => v + ' L'}}, x:{grid:{display:false}}}}});
const hbar = (id, obj, color) => new Chart(document.getElementById(id), {type:'bar', data:{labels:Object.keys(obj), datasets:[{data:Object.values(obj).map(v => +(v/1e5).toFixed(2)), backgroundColor:color, borderRadius:4}]},
  options:{indexAxis:'y', plugins:{legend:{display:false}, tooltip:{callbacks:{label:c => lakh(c.raw)}}}, scales:{x:{grid:{color:'#EEF1F4'}, ticks:{callback:v => v + ' L'}}, y:{grid:{display:false}}}}});
hbar('cat', @json($byCategory), '#0B2545');
hbar('ins', @json($byInsurer), '#C8A862');
new Chart(document.getElementById('seg'), {type:'doughnut', data:{labels:Object.keys(@json($bySegment)), datasets:[{data:Object.values(@json($bySegment)).map(v => +(v/1e5).toFixed(2)), backgroundColor:pal, borderWidth:0}]},
  options:{cutout:'62%', plugins:{legend:{position:'bottom'}, tooltip:{callbacks:{label:c => c.label + ': ' + lakh(c.raw)}}}}});
</script>
@endpush
