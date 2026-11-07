<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['next_follow_up' => 'date', 'expected_premium' => 'decimal:2'];
    public const STAGES = ['New', 'Contacted', 'Meeting', 'Quotation', 'Won', 'Lost'];
    public const SOURCES = ['Referral', 'Existing client', 'Website', 'WhatsApp', 'Event', 'POSP', 'Cold call'];

    public function rm() { return $this->belongsTo(User::class, 'rm_id'); }
    public function posp() { return $this->belongsTo(Posp::class); }
    public function client() { return $this->belongsTo(Client::class); }
    public function activities() { return $this->hasMany(LeadActivity::class)->latest(); }
    public function quotations() { return $this->hasMany(Quotation::class); }
    public function linesArray(): array { return array_values(array_filter(array_map('trim', explode(',', (string) $this->lines)))); }
}
