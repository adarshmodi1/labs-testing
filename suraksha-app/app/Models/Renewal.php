<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Renewal extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['next_action_on' => 'date', 'renewed_premium' => 'decimal:2'];
    public const STAGES = ['Not started', 'Data requested', 'Data received', 'Quotes in', 'Client approved', 'Renewed', 'Lost'];
    public const OPEN = ['Not started', 'Data requested', 'Data received', 'Quotes in', 'Client approved'];

    public function policy() { return $this->belongsTo(Policy::class); }
    public function owner() { return $this->belongsTo(User::class, 'owner_id'); }
    public function quotations() { return $this->hasMany(Quotation::class); }

    /** Expected stage for the days left, so a renewal that lags is flagged at risk. */
    public function isAtRisk(): bool
    {
        if (! in_array($this->stage, self::OPEN)) return false;
        $days = $this->policy->daysToExpiry();
        $idx = array_search($this->stage, self::STAGES);
        if ($days <= 7) return $idx < 4;
        if ($days <= 15) return $idx < 3;
        if ($days <= 30) return $idx < 2;
        if ($days <= 45) return $idx < 1;
        return false;
    }
}
