<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = ['title', 'provider', 'image_url', 'description'];

    public function bonuses() {
        return $this->hasMany(Bonus::class);
    }
}
