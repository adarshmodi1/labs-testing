<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['sent_at' => 'datetime', 'approved_at' => 'datetime', 'sum_insured' => 'decimal:2', 'current_premium' => 'decimal:2'];
    public const STATUSES = ['Draft', 'Requested', 'Quotes received', 'Sent to client', 'Approved', 'Declined'];

    public function client() { return $this->belongsTo(Client::class); }
    public function lead() { return $this->belongsTo(Lead::class); }
    public function renewal() { return $this->belongsTo(Renewal::class); }
    public function rm() { return $this->belongsTo(User::class, 'rm_id'); }
    public function options() { return $this->hasMany(QuoteOption::class)->orderBy('premium'); }
    public function approvedOption() { return $this->belongsTo(QuoteOption::class, 'approved_option_id'); }
    public function recommended() { return $this->options->firstWhere('is_recommended', true); }

    public static function nextRef(): string
    {
        $n = (int) static::max('id') + 1;
        return 'QT-' . now()->format('y') . '-' . str_pad((string) $n, 4, '0', STR_PAD_LEFT);
    }
}
