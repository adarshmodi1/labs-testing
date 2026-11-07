<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['loss_date' => 'date', 'attachments' => 'array', 'estimated_amount' => 'decimal:2', 'settled_amount' => 'decimal:2'];
    public const STATUSES = ['Requested', 'Intimated to insurer', 'Surveyor appointed', 'Documents pending', 'Under assessment', 'Settled', 'Repudiated'];
    public const OPEN = ['Requested', 'Intimated to insurer', 'Surveyor appointed', 'Documents pending', 'Under assessment'];
    public const LOSS_TYPES = ['Fire', 'Flood / storm', 'Burglary / theft', 'Machinery breakdown', 'Transit damage', 'Accident', 'Hospitalisation', 'Third-party injury', 'Death', 'Other'];

    public function client() { return $this->belongsTo(Client::class); }
    public function policy() { return $this->belongsTo(Policy::class); }
    public function handler() { return $this->belongsTo(User::class, 'handler_id'); }
    public function updates() { return $this->hasMany(ClaimUpdate::class)->latest(); }

    public static function nextRef(): string
    {
        $n = (int) static::max('id') + 1;
        return 'CLM-' . now()->format('y') . '-' . str_pad((string) $n, 4, '0', STR_PAD_LEFT);
    }
}
