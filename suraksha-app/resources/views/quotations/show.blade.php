@extends('layouts.app')
@section('title', $q->ref)
@section('crumb', 'Sales · Quotations')
@section('content')
<div class="ph">
  <div>
    <h1>{{ $q->ref }} · {{ $q->prospect_name }}</h1>
    <p>{{ $q->line }} · {{ $q->renewal_id ? 'Renewal' : 'New business' }} @if($q->sum_insured) · Sum insured {{ inr($q->sum_insured) }} @endif · RM {{ $q->rm?->name ?? '—' }}
      @if($q->lead) · Lead <a href="{{ route('leads.show', $q->lead) }}">{{ $q->lead->company }}</a>@endif
      @if($q->client) · Client <a href="{{ route('clients.show', $q->client) }}">{{ $q->client->name }}</a>@endif</p>
  </div>
  <div class="sp"></div>
  <span class="pill {{ stage_class($q->status) }}" style="font-size:13px;padding:5px 12px">{{ $q->status }}</span>
</div>

@if($q->renewal)
<div class="grid g4 mb">
  <div class="kpi"><div class="l">Expiring insurer</div><div class="v" style="font-size:18px">{{ $q->renewal->policy->insurer->short_name }}</div><div class="s">{{ $q->renewal->policy->policy_no }}</div></div>
  <div class="kpi"><div class="l">Expiring premium</div><div class="v" style="font-size:18px">{{ inr($q->current_premium) }}</div></div>
  <div class="kpi"><div class="l">Expires</div><div class="v" style="font-size:18px">{{ $q->renewal->policy->end_date->format('d M Y') }}</div><div class="s">{{ days_label($q->renewal->policy->daysToExpiry(), ' left') }}</div></div>
  <div class="kpi gold"><div class="l">Best quote so far</div><div class="v" style="font-size:18px">{{ $q->options->count() ? inr($q->options->min('premium')) : '—' }}</div>
    @if($q->options->count() && $q->current_premium)<div class="s">{{ round(((float) $q->current_premium - (float) $q->options->min('premium')) / (float) $q->current_premium * 100, 1) }}% vs expiring</div>@endif</div>
</div>
@endif

@if($q->requirement)<div class="flash info">{{ $q->requirement }}</div>@endif

@if($draft)
<div class="card mb" style="border:2px solid #B9A4E6">
  <div class="hd" style="background:linear-gradient(90deg,#F4EEFF,#EAF7F5)"><span class="chip-ai">AI</span><h2>Check what AI read from {{ $draft['file_name'] ?? 'the PDF' }}</h2><div class="sp"></div>
    <span class="small muted">Fields marked amber were read with low confidence</span>
    <form method="post" action="{{ route('quotations.ai.discard', $q) }}">@csrf<button class="btn sm ghost">Discard</button></form></div>
  @php $cf = $draft['confidence'] ?? []; $low = fn ($k) => in_array($cf[$k] ?? 'high', ['low', 'medium']) ? 'conf-low' : ''; @endphp
  <form method="post" action="{{ route('quotations.options.store', $q) }}" class="bd fg fg4">@csrf
    <input type="hidden" name="source" value="AI"><input type="hidden" name="pdf_path" value="{{ $draft['pdf_path'] }}">
    <input type="hidden" name="ai_meta" value="{{ json_encode(['confidence' => $cf, 'quote_reference' => $draft['quote_reference'] ?? null, 'model' => $draft['model'] ?? null, 'insurer_name_read' => $draft['insurer_name'] ?? null, 'usage' => $draft['usage'] ?? null]) }}">
    <div><label>Insurer @if(!($draft['insurer_id'] ?? null))<span class="down">· read as “{{ $draft['insurer_name'] ?? '?' }}”, pick one</span>@endif</label>
      <select class="in {{ $low('insurer_name') }} {{ !($draft['insurer_id'] ?? null) ? 'conf-low' : '' }}" name="insurer_id" required><option value="">Choose…</option>@foreach($insurers as $i)<option value="{{ $i->id }}" @selected(($draft['insurer_id'] ?? null) == $i->id)>{{ $i->short_name }}</option>@endforeach</select></div>
    <div><label>Premium before GST (₹)</label><input class="in {{ $low('premium') }}" name="premium" type="number" step="0.01" value="{{ $draft['premium'] ?? '' }}" required></div>
    <div><label>GST (₹)</label><input class="in {{ $low('gst') }}" name="gst" type="number" step="0.01" value="{{ $draft['gst'] ?? '' }}"></div>
    <div><label>Sum insured (₹)</label><input class="in {{ $low('sum_insured') }}" name="sum_insured" type="number" step="1" value="{{ $draft['sum_insured'] ?? '' }}"></div>
    <div><label>Option label</label><input class="in" name="option_label" value="{{ $draft['option_label'] ?? '' }}"></div>
    <div><label>Deductible</label><input class="in {{ $low('deductible') }}" name="deductible" value="{{ $draft['deductible'] ?? '' }}"></div>
    <div><label>Valid until</label><input class="in {{ $low('valid_until') }}" name="valid_until" type="date" value="{{ $draft['valid_until'] ?? '' }}"></div>
    <div><label>Insurer’s quote ref</label><input class="in" value="{{ $draft['quote_reference'] ?? '' }}" disabled></div>
    <div class="span2"><label>Key covers (one per line)</label><textarea class="in" name="key_covers">{{ implode("\n", (array) ($draft['key_covers'] ?? [])) }}</textarea></div>
    <div class="span2"><label>Exclusions / conditions (one per line)</label><textarea class="in" name="exclusions">{{ implode("\n", (array) ($draft['exclusions'] ?? [])) }}</textarea></div>
    <div class="spanall" style="display:flex;gap:8px;align-items:center"><button class="btn pri">Looks right · add to comparison</button><span class="small muted">Nothing is saved until you confirm.</span></div>
  </form>
</div>
@endif

<div class="grid" style="grid-template-columns:minmax(0,1fr) 340px">
  <div>
    <div class="card">
      <div class="hd"><h2>Comparison</h2><span class="muted small">{{ $q->options->count() }} quotes · sorted by premium</span><div class="sp"></div>
        @if($q->sent_at)<span class="small muted">Sent to client {{ $q->sent_at->format('d M, g:i a') }}</span>@endif</div>
      <div class="bd">
        @if($q->options->count())
          @include('quotations._compare', ['opts' => $q->options, 'admin' => true])
        @else
          <div class="empty">No insurer quotes yet. Add them on the right, by hand or by uploading the insurer’s PDF.</div>
        @endif
      </div>
    </div>

    @if($q->status === 'Approved' && $q->approvedOption)
      <div class="flash ok mt">✓ Approved {{ $q->approvedOption->insurer->short_name }} at {{ inr($q->approvedOption->total()) }} incl. GST · by {{ $q->approved_by }} · {{ $q->approved_at?->format('d M Y, g:i a') }}</div>
    @endif

    <div class="card mt">
      <div class="hd"><h2>Send to client</h2><span class="small muted">The client sees the options marked “shown to client” in their portal and can approve one.</span></div>
      <form method="post" action="{{ route('quotations.send', $q) }}" class="bd">@csrf
        <label>Why Suraksha recommends this option (shown to the client)</label>
        <textarea class="in" name="recommendation_note" required placeholder="e.g. Broader cover including earthquake, lower deductible, and a strong claims record with this insurer.">{{ old('recommendation_note', $q->recommendation_note) }}</textarea>
        <div style="display:flex;gap:8px;margin-top:10px;align-items:center;flex-wrap:wrap">
          <button class="btn pri">{{ $q->status === 'Sent to client' ? 'Update and resend' : 'Send to client portal' }}</button>
          @if($q->client && $q->client->portalUsers->isEmpty())<span class="small down">This client has no portal login yet.</span>@endif
          <span class="sp" style="flex:1"></span>
        </div>
      </form>
      <form method="post" action="{{ route('quotations.status', $q) }}" class="bd" style="border-top:1px solid var(--line);display:flex;gap:8px;align-items:center;flex-wrap:wrap">@csrf
        <span class="small muted">Record the outcome:</span>
        <select class="in" name="option_id" style="width:auto"><option value="">Approved option…</option>@foreach($q->options as $o)<option value="{{ $o->id }}">{{ $o->insurer->short_name }} · {{ inr($o->premium) }}</option>@endforeach</select>
        <button class="btn sm teal" name="status" value="Approved">Client approved</button>
        <button class="btn sm danger" name="status" value="Declined">Client declined</button>
      </form>
    </div>
  </div>

  <div>
    <div class="card">
      <div class="hd"><span class="chip-ai">AI</span><h2>Read an insurer’s PDF</h2></div>
      <form method="post" action="{{ route('quotations.ai', $q) }}" enctype="multipart/form-data" class="bd" onsubmit="this.querySelector('button').disabled=true;this.querySelector('button').innerText='Reading the PDF…'">@csrf
        <p class="small muted" style="margin-bottom:10px">Upload the quote exactly as the insurer sent it. AI fills in the comparison; you check it before it’s added.</p>
        <input class="in" type="file" name="pdf" accept="application/pdf" required>
        <button class="btn gold" style="margin-top:10px;width:100%;justify-content:center" @disabled(! $hasKey)>Read with AI</button>
        @unless($hasKey)<p class="small down" style="margin-top:8px">Add an Anthropic API key in <a href="{{ route('settings.edit') }}">Settings</a> to switch this on.</p>@endunless
        <p class="xs muted" style="margin-top:8px">Sample PDFs to try: <a href="{{ asset('samples/sample-quote-icici-lombard.pdf') }}" target="_blank">ICICI Lombard</a> · <a href="{{ asset('samples/sample-quote-new-india.pdf') }}" target="_blank">New India</a> · <a href="{{ asset('samples/sample-quote-hdfc-ergo.pdf') }}" target="_blank">HDFC ERGO</a></p>
      </form>
    </div>
    <div class="card mt">
      <div class="hd"><h2>Enter a quote by hand</h2></div>
      <form method="post" action="{{ route('quotations.options.store', $q) }}" class="bd fg">@csrf
        <div><label>Insurer</label><select class="in" name="insurer_id" required><option value="">Choose…</option>@foreach($insurers as $i)<option value="{{ $i->id }}">{{ $i->short_name }}</option>@endforeach</select></div>
        <div class="fg fg2"><div><label>Premium before GST (₹)</label><input class="in" name="premium" type="number" step="0.01" required></div><div><label>GST (₹)</label><input class="in" name="gst" type="number" step="0.01" placeholder="18% if blank"></div></div>
        <div class="fg fg2"><div><label>Sum insured (₹)</label><input class="in" name="sum_insured" type="number" value="{{ $q->sum_insured ? (int) $q->sum_insured : '' }}"></div><div><label>Valid until</label><input class="in" name="valid_until" type="date"></div></div>
        <div><label>Deductible</label><input class="in" name="deductible" placeholder="e.g. 5% of claim, min ₹25,000"></div>
        <div><label>Option label (optional)</label><input class="in" name="option_label" placeholder="e.g. Option B – higher deductible"></div>
        <div><label>Key covers (one per line)</label><textarea class="in" name="key_covers"></textarea></div>
        <div><label>Exclusions / conditions</label><textarea class="in" name="exclusions" style="min-height:60px"></textarea></div>
        <button class="btn pri">Add to comparison</button>
      </form>
    </div>
  </div>
</div>
@endsection
