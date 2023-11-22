<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function wordset()
    {
        return $this->belongsTo(Wordset::class, 'wordset_id', 'id');
    }
}
