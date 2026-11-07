<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CustomerUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index(Request $r)
    {
        $q = Client::with('rm')->withCount(['policies as active_count' => fn ($p) => $p->where('status', 'Active')])
            ->withSum(['policies as active_premium' => fn ($p) => $p->where('status', 'Active')], 'premium')->orderByDesc('active_premium');
        if ($r->filled('segment')) $q->where('segment', $r->segment);
        if ($r->filled('q')) $q->where(fn ($w) => $w->where('name', 'like', "%{$r->q}%")->orWhere('city', 'like', "%{$r->q}%")->orWhere('industry', 'like', "%{$r->q}%"));
        return view('clients.index', ['clients' => $q->get()]);
    }

    public function show(Client $client)
    {
        $client->load(['policies' => fn ($q) => $q->with('insurer', 'renewal')->orderBy('status')->orderBy('end_date'), 'claims.policy', 'quotations.options', 'portalUsers', 'rm', 'posp']);
        return view('clients.show', compact('client'));
    }

    public function portalUser(Request $r, Client $client)
    {
        $data = $r->validate(['name' => 'required|string|max:100', 'email' => 'required|email|unique:customer_users,email']);
        $password = 'Suraksha-' . Str::upper(Str::random(6));
        CustomerUser::create($data + ['client_id' => $client->id, 'password' => $password]);
        return back()->with('ok', "Portal login created for {$data['email']}. Temporary password: {$password} — share it with the client securely.");
    }
}
