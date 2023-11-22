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

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_topic_pivot', 'topic_id', 'user_id');
    }
}
