<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\ClaimUpdate;
use App\Models\Policy;
use App\Models\Quotation;
use App\Models\QuoteOption;
use App\Models\Renewal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

/** The client-facing portal. Every query is scoped to the signed-in client's company. */
class PortalController extends Controller
{
    private function client() { return Auth::guard('customer')->user()->client; }

    public function showLogin() { return view('portal.login'); }

    public function login(Request $r)
    {
        $cred = $r->validate(['email' => 'required|email', 'password' => 'required']);
        if (Auth::guard('customer')->attempt($cred, $r->boolean('remember'))) {
            $r->session()->regenerate();
            Auth::guard('customer')->user()->update(['last_login_at' => now()]);
            return redirect()->intended(route('portal.home'));
        }
        return back()->withErrors(['email' => 'Those details don’t match a client login.'])->onlyInput('email');
    }

    public function logout(Request $r)
    {
        Auth::guard('customer')->logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route('portal.login');
    }

    public function home()
    {
        $c = $this->client();
        $policies = $c->policies()->with('insurer')->where('status', 'Active')->orderBy('end_date')->get();
        $upcoming = $policies->filter(fn ($p) => $p->daysToExpiry() <= 90);
        $quotes = $c->quotations()->where('status', 'Sent to client')->with('options.insurer')->get();
        $claims = $c->claims()->with('policy')->whereIn('status', Claim::OPEN)->latest()->get();
        return view('portal.home', compact('c', 'policies', 'upcoming', 'quotes', 'claims'));
    }

    public function policies(Request $r)
    {
        $c = $this->client();
        $all = $c->policies()->with('insurer')->where('status', 'Active')->orderBy('end_date')->get();
        $cats = $all->map(fn ($p) => $p->category())->unique()->values();
        $policies = $r->filled('cat') ? $all->filter(fn ($p) => $p->category() === $r->cat) : $all;
        return view('portal.policies', compact('c', 'policies', 'cats', 'all'));
    }

    public function policy(Policy $policy)
    {
        abort_unless($policy->client_id === $this->client()->id, 404);
        $policy->load('insurer', 'claims', 'renewal', 'rm');
        return view('portal.policy', ['c' => $this->client(), 'policy' => $policy]);
    }

    public function renewals()
    {
        $c = $this->client();
        $rows = $c->policies()->with('insurer', 'renewal.quotations')->where('status', 'Active')->where('end_date', '<=', now()->addDays(120))->orderBy('end_date')->get();
        return view('portal.renewals', compact('c', 'rows'));
    }

    public function quotes()
    {
        $c = $this->client();
        $quotes = $c->quotations()->whereIn('status', ['Sent to client', 'Approved', 'Declined'])->whereNotNull('sent_at')->with('options.insurer', 'approvedOption.insurer')->latest('sent_at')->get();
        return view('portal.quotes', compact('c', 'quotes'));
    }

    public function quote(Quotation $quotation)
    {
        abort_unless($quotation->client_id === $this->client()->id && $quotation->sent_at, 404);
        $quotation->load(['options' => fn ($q) => $q->where('show_to_client', true)->with('insurer'), 'rm', 'renewal.policy.insurer']);
        return view('portal.quote', ['c' => $this->client(), 'q' => $quotation]);
    }

    public function approve(Request $r, Quotation $quotation)
    {
        abort_unless($quotation->client_id === $this->client()->id && $quotation->status === 'Sent to client', 404);
        $data = $r->validate(['option_id' => ['required', Rule::exists('quote_options', 'id')->where('quotation_id', $quotation->id)->where('show_to_client', true)]]);
        $u = Auth::guard('customer')->user();
        $quotation->update(['status' => 'Approved', 'approved_option_id' => $data['option_id'], 'approved_at' => now(), 'approved_by' => $u->name]);
        if ($quotation->renewal) $quotation->renewal->update(['stage' => 'Client approved', 'notes' => 'Approved online by ' . $u->name . ' on ' . now()->format('d M Y') . '.']);
        $opt = QuoteOption::with('insurer')->find($data['option_id']);
        return redirect()->route('portal.quote', $quotation)->with('ok', "Thank you. You approved {$opt->insurer->short_name}. Your Suraksha team will share the payment details and issue the policy.");
    }

    public function claims()
    {
        $c = $this->client();
        return view('portal.claims', ['c' => $c, 'claims' => $c->claims()->with('policy.insurer')->latest()->get()]);
    }

    public function newClaim(Request $r)
    {
        $c = $this->client();
        return view('portal.claim-new', ['c' => $c, 'policies' => $c->policies()->with('insurer')->where('status', 'Active')->orderBy('line')->get(), 'selected' => $r->policy]);
    }

    public function storeClaim(Request $r)
    {
        $c = $this->client();
        $data = $r->validate([
            'policy_id' => ['required', Rule::exists('policies', 'id')->where('client_id', $c->id)],
            'loss_date' => 'required|date|before_or_equal:today', 'loss_type' => ['required', Rule::in(Claim::LOSS_TYPES)],
            'loss_location' => 'nullable|string|max:200', 'description' => 'required|string|min:10|max:3000',
            'estimated_amount' => 'nullable|numeric|min:0', 'contact_name' => 'required|string|max:100', 'contact_phone' => 'required|string|max:20',
            'files' => 'nullable|array|max:6', 'files.*' => 'file|mimes:jpg,jpeg,png,pdf,heic|max:10240',
        ]);
        $claim = Claim::create(collect($data)->except('files')->all() + [
            'ref' => Claim::nextRef(), 'client_id' => $c->id, 'status' => 'Requested', 'raised_by' => 'Client',
            'handler_id' => User::where('role', 'claims')->where('is_active', true)->value('id'),
        ]);
        $files = [];
        foreach ($r->file('files', []) as $f) {
            $files[] = ['name' => $f->getClientOriginalName(), 'path' => $f->store("claims/{$claim->id}", 'local')];
        }
        $claim->update(['attachments' => $files]);
        ClaimUpdate::create(['claim_id' => $claim->id, 'status' => 'Requested', 'note' => 'Claim request submitted from the client portal' . ($files ? ' with ' . count($files) . ' attachment(s).' : '.')]);
        return redirect()->route('portal.claim', $claim)->with('ok', "Claim request {$claim->ref} received. Our claims team will call you shortly and keep this page updated.");
    }

    public function claim(Claim $claim)
    {
        abort_unless($claim->client_id === $this->client()->id, 404);
        $claim->load(['policy.insurer', 'handler', 'updates' => fn ($q) => $q->where('visible_to_client', true)]);
        return view('portal.claim', ['c' => $this->client(), 'claim' => $claim]);
    }

    public function claimFile(Claim $claim, int $i)
    {
        abort_unless($claim->client_id === $this->client()->id, 404);
        $f = ($claim->attachments ?? [])[$i] ?? null;
        abort_unless($f && Storage::disk('local')->exists($f['path']), 404);
        return Storage::disk('local')->response($f['path'], $f['name']);
    }
}
