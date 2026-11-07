<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];

    public const ROLES = [
        'admin' => 'Admin',
        'ceo' => 'CEO / Leadership',
        'principal_officer' => 'Principal Officer',
        'business_head' => 'Business Head',
        'rm' => 'Relationship Manager',
        'operations' => 'Operations / Data entry',
        'claims' => 'Claims Executive',
        'finance' => 'Finance',
    ];

    protected function casts(): array
    {
        return ['password' => 'hashed', 'can_login' => 'boolean', 'is_active' => 'boolean', 'joined_on' => 'date', 'annual_target' => 'decimal:2'];
    }

    public function roleLabel(): string { return self::ROLES[$this->role] ?? ucfirst($this->role); }
    public function clients() { return $this->hasMany(Client::class, 'rm_id'); }
    public function policies() { return $this->hasMany(Policy::class, 'rm_id'); }
    public function leads() { return $this->hasMany(Lead::class, 'rm_id'); }
    public function posps() { return $this->hasMany(Posp::class, 'rm_id'); }
    public function initials(): string { return collect(explode(' ', $this->name))->map(fn ($p) => mb_substr($p, 0, 1))->take(2)->implode(''); }
}
