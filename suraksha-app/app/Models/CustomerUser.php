<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class CustomerUser extends Authenticatable
{
    protected $guarded = ['id'];
    protected $hidden = ['password', 'remember_token'];
    protected function casts(): array { return ['password' => 'hashed', 'last_login_at' => 'datetime']; }
    public function client() { return $this->belongsTo(Client::class); }
}
