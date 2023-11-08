<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function wordsets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Wordset::class);
    }
}
