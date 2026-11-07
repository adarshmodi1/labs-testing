<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuoteOption extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['valid_until' => 'date', 'is_recommended' => 'boolean', 'show_to_client' => 'boolean', 'ai_meta' => 'array', 'premium' => 'decimal:2', 'gst' => 'decimal:2', 'sum_insured' => 'decimal:2'];

    public function quotation() { return $this->belongsTo(Quotation::class); }
    public function insurer() { return $this->belongsTo(Insurer::class); }
    public function total(): float { return (float) $this->premium + (float) $this->gst; }
    public function coversList(): array { return array_values(array_filter(array_map('trim', preg_split('/\r?\n|;/', (string) $this->key_covers)))); }
    public function exclusionsList(): array { return array_values(array_filter(array_map('trim', preg_split('/\r?\n|;/', (string) $this->exclusions)))); }
}
