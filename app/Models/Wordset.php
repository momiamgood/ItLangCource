<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordset extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = ['name', 'topic_id'];
    public function words()
    {
        return $this->hasMany(Word::class);
    }
}
