<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordset extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $guarded = [];
    public function words(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Word::class);
    }
}
