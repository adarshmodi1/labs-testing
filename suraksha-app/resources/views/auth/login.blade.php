<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sign in · Suraksha Platform</title><link rel="stylesheet" href="{{ asset('css/app.css') }}?v=1"></head>
<body>
<div class="auth">
  <div class="art">
    <div class="brand" style="padding:0;border:0"><div class="mark">S</div><div><b>Suraksha Insurance Brokers</b><span>IRDAI direct broker · Licence 177</span></div></div>
    <div>
      <h1>Your security is our priority.</h1>
      <p>Sales, quotations, renewals, claims and the business dashboard in one place for the Suraksha team.</p>
    </div>
    <p class="small" style="color:#7F95B1">Prototype built by Systems by AD · sample data only</p>
  </div>
  <div class="frm"><div class="box">
    <h1>Team sign in</h1>
    <p class="muted" style="margin:6px 0 22px">Use your Suraksha work email.</p>
    @if($errors->any())<div class="flash bad">{{ $errors->first() }}</div>@endif
    <form method="post" action="{{ url('/login') }}" class="fg">@csrf
      <div><label>Email</label><input class="in" type="email" name="email" value="{{ old('email', 'admin@suraksha.demo') }}" required autofocus></div>
      <div><label>Password</label><input class="in" type="password" name="password" required></div>
      <label class="check"><input type="checkbox" name="remember"> Keep me signed in</label>
      <button class="btn pri" style="justify-content:center;padding:10px">Sign in</button>
    </form>
    <div class="demo"><b>Demo login</b><br>admin@suraksha.demo · Suraksha@2026</div>
    <p class="small muted" style="margin-top:18px">Are you a Suraksha client? <a href="{{ route('portal.login') }}">Sign in to the client portal →</a></p>
  </div></div>
</div>
</body></html>
