<?php

namespace App\Models;

use Carbon\Carbon;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Apero extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'start',
        'address',
        'postulable',
        'active',
    ];

    protected $casts = [
        'start' => 'datetime',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function postulants()
    {
        return $this->belongsToMany(User::class)->using(Postulation::class)->withPivot(['id', 'status', 'motivation', 'message', 'message_cancel'])->as('postulation');
    }

    public function closePostulation()
    {
        $this->update([
            'postulable' => false,
        ]);
    }
    
    public function cancelApero()
    {
        $this->update([
            'active' => false,
            'postulable' => false,
        ]);
    }
    
    public function getIsOpenForPostulationAttribute()
    {
        return $this->postulable;
    }

    public function getIsCancelledAttribute()
    {
        return !$this->active;
    }

    public function getStartFormAttribute()
    {
        return Carbon::parse($this->start)->format('Y-m-d\TH:i');
    }

    public function getDisplayAddressAttribute()
    {
        $user = Auth::user();

        if ($user) {
            if ($user->id === $this->host_id) {
                return true;
            }

            $postulation = Postulation::where('apero_id', $this->id)->where('user_id', $user->id)->first();

            if ($postulation && $postulation->isAccepted) {
                return true;
            }
        }

        return false;
    }
}
