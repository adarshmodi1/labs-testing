{{-- Side-by-side quote comparison. $q quotation, $opts options, $admin bool --}}
@php
  $opts = $opts->sortBy('premium')->values();
  $cheapest = $opts->min('premium');
  $cols = max(1, min(4, $opts->count()));
@endphp
<div class="cmp" style="grid-template-columns:repeat({{ $cols }},minmax(0,1fr))">
  @foreach($opts as $o)
    <div class="opt {{ $o->is_recommended ? 'rec' : '' }}" style="{{ $admin && ! $o->show_to_client ? 'opacity:.55' : '' }}">
      @if($o->is_recommended)<span class="ribbon">★ RECOMMENDED BY SURAKSHA</span>@endif
      <div class="ins"><span class="dot" style="background:{{ $o->insurer->colour }};width:10px;height:10px"></span>{{ $o->insurer->short_name }}
        @if($admin && $o->source === 'AI')<span class="chip-ai" title="Read from PDF by AI">AI</span>@endif
      </div>
      @if($o->option_label)<div class="small muted">{{ $o->option_label }}</div>@endif
      <div class="prem">{{ inr($o->premium) }}</div>
      <div class="small muted">+ GST {{ inr($o->gst) }} · total {{ inr($o->total()) }}</div>
      @if($q->current_premium)
        @php $diff = (float) $q->current_premium - (float) $o->premium; @endphp
        <div class="small" style="margin-top:4px">@if($diff > 0)<span class="save">Saves {{ inr($diff) }} ({{ round($diff / $q->current_premium * 100, 1) }}%) vs expiring</span>@else<span class="down">{{ inr(abs($diff)) }} more than expiring</span>@endif</div>
      @elseif($o->premium == $cheapest && $opts->count() > 1)
        <div class="small save" style="margin-top:4px">Lowest premium</div>
      @endif
      <div style="margin-top:10px">
        <div class="rowk"><span class="muted">Sum insured</span><b>{{ $o->sum_insured ? inr_short($o->sum_insured) : '—' }}</b></div>
        <div class="rowk"><span class="muted">Deductible</span><b style="text-align:right">{{ $o->deductible ?? '—' }}</b></div>
        <div class="rowk"><span class="muted">Valid until</span><b>{{ $o->valid_until?->format('d M Y') ?? '—' }}</b></div>
      </div>
      <div class="grow">
        @if($o->coversList())<div class="small" style="margin-top:10px;font-weight:700;color:var(--navy)">Covers</div><ul>@foreach($o->coversList() as $c)<li>{{ $c }}</li>@endforeach</ul>@endif
        @if($o->exclusionsList())<div class="small" style="margin-top:8px;font-weight:700;color:var(--muted)">Exclusions / conditions</div><ul class="muted">@foreach($o->exclusionsList() as $c)<li>{{ $c }}</li>@endforeach</ul>@endif
      </div>
      @if($admin)
        <div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:12px;border-top:1px solid var(--line);padding-top:10px">
          @unless($o->is_recommended)<form class="inline" method="post" action="{{ route('quotations.recommend', [$q, $o]) }}">@csrf<button class="btn sm gold">★ Recommend</button></form>@endunless
          <form class="inline" method="post" action="{{ route('quotations.visibility', [$q, $o]) }}">@csrf<button class="btn sm" title="Choose whether the client sees this option">{{ $o->show_to_client ? 'Shown to client' : 'Hidden from client' }}</button></form>
          @if($o->pdf_path)<a class="btn sm" href="{{ route('files.quote', $o) }}" target="_blank">PDF</a>@endif
          <form class="inline" method="post" action="{{ route('quotations.options.destroy', [$q, $o]) }}" onsubmit="return confirm('Remove this quote?')">@csrf @method('delete')<button class="btn sm ghost danger">Remove</button></form>
        </div>
      @else
        @if($q->status === 'Sent to client')
          <form method="post" action="{{ route('portal.quote.approve', $q) }}" style="margin-top:12px" onsubmit="return confirm('Approve {{ $o->insurer->short_name }} at {{ inr($o->total()) }} including GST?')">@csrf
            <input type="hidden" name="option_id" value="{{ $o->id }}">
            <button class="btn {{ $o->is_recommended ? 'gold' : '' }}" style="width:100%;justify-content:center">Approve this option</button>
          </form>
        @elseif($q->approved_option_id === $o->id)
          <div class="pill ok" style="margin-top:12px;justify-content:center">✓ Approved by you</div>
        @endif
      @endif
    </div>
  @endforeach
</div>
