<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimUpdate extends Model
{
    protected $guarded = ['id'];
    protected $casts = ['visible_to_client' => 'boolean'];
    public function user() { return $this->belongsTo(User::class); }
}
