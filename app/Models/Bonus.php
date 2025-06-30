<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable = ['slot_id', 'session_id', 'activated_at'];

    public function slot() {
        return $this->belongsTo(Slot::class);
    }
}
