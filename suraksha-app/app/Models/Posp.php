<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posp extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['certified_on' => 'date'];
    public const STATUSES = ['Applied', 'In training', 'Certified', 'Active', 'Inactive'];
    public const LINES = ['Motor', 'Health', 'Personal Accident', 'Travel', 'Home', 'Term Life'];

    public function rm() { return $this->belongsTo(User::class, 'rm_id'); }
    public function policies() { return $this->hasMany(Policy::class); }
    public function leads() { return $this->hasMany(Lead::class); }
    public function premium(): float { return (float) $this->policies()->sum('premium'); }
}
