<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserTopicPivot extends Pivot
{
    public $timestamps = false;
    protected $guarded = [];
}
