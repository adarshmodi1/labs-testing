<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::withCount(['clients', 'posps', 'leads' => fn ($q) => $q->whereNotIn('stage', ['Won', 'Lost'])])
            ->withSum(['policies as active_premium' => fn ($q) => $q->where('status', 'Active')], 'premium')->orderBy('role')->orderBy('name')->get();
        return view('team.index', compact('users'));
    }

    public function create() { return view('team.form', ['user' => new User(['role' => 'rm', 'branch' => 'Kolkata', 'is_active' => true])]); }

    public function store(Request $r)
    {
        User::create($this->validated($r));
        return redirect()->route('team.index')->with('ok', 'Team member added.');
    }

    public function edit(User $user) { return view('team.form', compact('user')); }

    public function update(Request $r, User $user)
    {
        $data = $this->validated($r, $user);
        if ($user->id === auth()->id() && (! $data['can_login'] || ! $data['is_active'])) return back()->with('bad', 'You can’t remove your own login.');
        if (empty($data['password'])) unset($data['password']);
        $user->update($data);
        return redirect()->route('team.index')->with('ok', 'Saved.');
    }

    private function validated(Request $r, ?User $user = null): array
    {
        $data = $r->validate([
            'name' => 'required|string|max:100', 'email' => ['required', 'email', Rule::unique('users')->ignore($user?->id)],
            'phone' => 'nullable|string|max:20', 'role' => ['required', Rule::in(array_keys(User::ROLES))], 'designation' => 'nullable|string|max:100',
            'branch' => 'required|string|max:60', 'annual_target' => 'nullable|numeric|min:0', 'joined_on' => 'nullable|date',
            'password' => [$r->boolean('can_login') && ! $user?->password ? 'required' : 'nullable', 'nullable', 'string', 'min:8'],
        ]);
        $data['can_login'] = $r->boolean('can_login');
        $data['is_active'] = $r->boolean('is_active');
        $data['annual_target'] = $data['annual_target'] ?? 0;
        return $data;
    }
}
