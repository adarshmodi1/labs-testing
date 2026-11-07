@extends('layouts.app')
@section('title', 'Settings')
@section('crumb', 'System · Settings')
@section('content')
<div class="ph"><div><h1>Settings</h1></div></div>
<div class="grid g2">
  <div class="card">
    <div class="hd"><span class="chip-ai">AI</span><h2>AI quote reading</h2></div>
    <form method="post" action="{{ route('settings.update') }}" class="bd fg">@csrf
      <p class="small muted">Insurer quote PDFs are read by Claude through Anthropic’s API. Usage is billed by Anthropic to the account that owns the key — roughly ₹1–3 per quote document.</p>
      <div><label>Anthropic API key</label>
        @if($masked)<div class="small" style="margin-bottom:6px">Saved: <code>{{ $masked }}</code></div>@endif
        <input class="in" type="password" name="anthropic_api_key" placeholder="{{ $masked ? 'Paste a new key to replace it' : 'sk-ant-…' }}" autocomplete="off"></div>
      <div><label>Model</label><input class="in" name="anthropic_model" value="{{ $model }}"><div class="hint">Default {{ \App\Services\QuoteReader::DEFAULT_MODEL }}. Use any current Claude model that reads PDFs.</div></div>
      @if($masked)<label class="check"><input type="checkbox" name="clear_key" value="1"> Remove the saved key</label>@endif
      <div style="display:flex;gap:8px"><button class="btn pri">Save</button></div>
    </form>
    <form method="post" action="{{ route('settings.test') }}" class="bd" style="border-top:1px solid var(--line)">@csrf<button class="btn">Test connection</button></form>
  </div>
  <div class="card">
    <div class="hd"><h2>Insurers</h2><span class="small muted">API status as researched for the proposal</span></div>
    <div class="bd flush"><table class="t">
      <tr><th>Insurer</th><th>Type</th><th>API</th><th class="num">Active policies</th></tr>
      @foreach($insurers as $i)
        <tr><td><span class="dot" style="background:{{ $i->colour }}"></span> <b>{{ $i->short_name }}</b></td><td class="small">{{ $i->category }}</td>
        <td><span class="pill {{ ['Partner API confirmed' => 'ok', 'Likely' => 'warn', 'To request' => 'info', 'Email / portal' => 'muted'][$i->api_status] ?? '' }}">{{ $i->api_status }}</span></td><td class="num">{{ $i->policies_count }}</td></tr>
      @endforeach
    </table></div>
  </div>
</div>
@endsection
