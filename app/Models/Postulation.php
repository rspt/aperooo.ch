<?php

namespace App\Models;

use App\Models\Apero;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Postulation extends Pivot
{
    protected $table = 'apero_user';

    public function accept($message)
    {
        $this->update([
            'status' => 'accepted',
            'message' => $message ? $message : $this->message,
        ]);
    }

    public function cancel($messageCancel)
    {
        $this->update([
            'status' => 'cancelled',
            'message_cancel' => $messageCancel ? $messageCancel : $this->messageCancel,
        ]);
    }

    public function decline($message)
    {
        $this->update([
            'status' => 'declined',
            'message' => $message ? $message : $this->message,
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
