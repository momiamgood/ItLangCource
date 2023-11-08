<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserWordPivot extends Pivot
{
    public $timestamps = false;
    protected $guarded = [];
}
