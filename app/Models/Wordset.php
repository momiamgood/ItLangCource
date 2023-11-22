<?php

namespace App\Models;

use App\Http\Controllers\Api\TopicController;
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

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topic_id', 'id');
    }

}
