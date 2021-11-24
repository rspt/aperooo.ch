<?php

namespace App\Models;

use App\Models\Apero;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Postulation extends Pivot
{
    protected $table = 'apero_user';

    protected $casts = [
        'user_id' => 'integer', // force casting to avoid string on old databases (o2switch) 
        'apero_id' => 'integer', // force casting to avoid string on old databases (o2switch) 
    ];

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

    public function getIsDeclinedAttribute()
    {
        return $this->status === 'declined';
    }

    public function getIsCancelledAttribute()
    {
        return $this->status === 'cancelled';
    }
}
