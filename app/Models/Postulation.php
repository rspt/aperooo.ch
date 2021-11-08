<?php

namespace App\Models;

use App\Models\Apero;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Postulation extends Pivot
{
    protected $table = 'apero_user';

    public function accept()
    {
        $this->update([
            'status' => 'accepted',
        ]);
    }

    public function cancel()
    {
        $this->update([
            'status' => 'cancelled',
        ]);
    }

    public function decline()
    {
        $this->update([
            'status' => 'declined',
        ]);
    }

    public function getIsOpenAttribute()
    {
        return $this->status === 'open';
    }

    public function getIsAcceptedAttribute()
    {
        return $this->status === 'accepted';
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }
}
