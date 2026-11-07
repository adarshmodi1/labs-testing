<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date', 'sum_insured' => 'decimal:2', 'premium' => 'decimal:2', 'gst' => 'decimal:2', 'commission_rate' => 'decimal:2'];

    public const LINES = [
        'Fire & Allied Perils' => 'Property',
        'Business Interruption' => 'Property',
        'Machinery Breakdown' => 'Engineering',
        'Contractors All Risk (CAR)' => 'Engineering',
        'Erection All Risk (EAR)' => 'Engineering',
        'Marine Cargo' => 'Marine',
        'Marine Open Cover' => 'Marine',
        'Public Liability' => 'Liability',
        'Product Liability' => 'Liability',
        'Directors & Officers' => 'Liability',
        "Workmen's Compensation" => 'Liability',
        'Surety Bond' => 'Financial lines',
        'Trade Credit' => 'Financial lines',
        'Group Mediclaim (GMC)' => 'Employee benefits',
        'Group Term Life (GTL)' => 'Employee benefits',
        'Group Personal Accident' => 'Employee benefits',
        'Keyman Insurance' => 'Life',
        'Term Life' => 'Life',
        'Motor - Commercial Fleet' => 'Motor',
        'Motor - Private Car' => 'Motor',
        'Health - Family Floater' => 'Health',
    ];

    public static function categoryOf(string $line): string { return self::LINES[$line] ?? 'Other'; }
    public function category(): string { return self::categoryOf($this->line); }
    public function client() { return $this->belongsTo(Client::class); }
    public function insurer() { return $this->belongsTo(Insurer::class); }
    public function rm() { return $this->belongsTo(User::class, 'rm_id'); }
    public function posp() { return $this->belongsTo(Posp::class); }
    public function renewal() { return $this->hasOne(Renewal::class); }
    public function claims() { return $this->hasMany(Claim::class); }
    public function commission(): float { return round((float) $this->premium * (float) $this->commission_rate / 100, 2); }
    public function totalPremium(): float { return (float) $this->premium + (float) $this->gst; }
    public function daysToExpiry(): int { return (int) now()->startOfDay()->diffInDays($this->end_date, false); }
}
