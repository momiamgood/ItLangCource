<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name','user_id'];

    public function wordsets()
    {
        return $this->hasMany(Wordset::class);
    }
}
