<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['client_since' => 'date'];
    public const SEGMENTS = ['Large corporate', 'SME', 'HNI', 'Retail'];

    public function rm() { return $this->belongsTo(User::class, 'rm_id'); }
    public function posp() { return $this->belongsTo(Posp::class); }
    public function policies() { return $this->hasMany(Policy::class); }
    public function claims() { return $this->hasMany(Claim::class); }
    public function quotations() { return $this->hasMany(Quotation::class); }
    public function portalUsers() { return $this->hasMany(CustomerUser::class); }
}
