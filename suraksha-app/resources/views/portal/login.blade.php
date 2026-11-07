<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Client sign in · Suraksha</title><link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1"></head>
<body>
<div class="auth client">
  <div class="art">
    <div class="brand" style="padding:0;border:0"><div class="mark">S</div><div><b>Suraksha Insurance Brokers</b><span style="color:#BFE6DF">Client portal</span></div></div>
    <div><h1>All your policies, renewals and claims in one place.</h1>
      <p>See what you’re covered for, approve renewal quotes, and report a claim from your phone.</p></div>
    <p class="small" style="color:#A7D8CF">Prototype · sample data only</p>
  </div>
  <div class="frm"><div class="box">
    <h1>Client sign in</h1>
    <p class="muted" style="margin:6px 0 22px">Use the login Suraksha shared with you.</p>
    @if($errors->any())<div class="flash bad">{{ $errors->first() }}</div>@endif
    <form method="post" action="{{ url('/portal/login') }}" class="fg">@csrf
      <div><label>Email</label><input class="in" type="email" name="email" value="{{ old('email', 'client@easterncastings.demo') }}" required autofocus></div>
      <div><label>Password</label><input class="in" type="password" name="password" required></div>
      <button class="btn teal" style="justify-content:center;padding:10px">Sign in</button>
    </form>
    <div class="demo"><b>Demo client login</b><br>client@easterncastings.demo · Client@2026</div>
    <p class="small muted" style="margin-top:18px">Suraksha team? <a href="{{ route('login') }}">Team sign in →</a></p>
  </div></div>
</div>
</body></html>
