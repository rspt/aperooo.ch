<?php

namespace App\Models;

use App\Models\Apero;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Postulation extends Pivot
{
    protected $table = 'apero_user';

    public function getIsAcceptedAttribute()
    {
        return $this->status === 'accepted';
    }
}
