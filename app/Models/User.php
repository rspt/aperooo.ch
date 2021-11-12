<?php

namespace App\Models;

use App\Models\Apero;
use App\Models\Postulation;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function aperos()
    {
        return $this->hasMany(Apero::class, 'host_id');
    }

    public function postulations()
    {
        return $this->belongsToMany(Apero::class)->using(Postulation::class)->withPivot(['id', 'status']);
    }

    public function isHostOf(Apero $apero)
    {
        return $this->id === $apero->host_id;
    }

    public function hasAlreadyPostulatedFor(Apero $apero)
    {
        return Postulation::where('apero_id', $apero->id)->where('user_id', $this->id)->exists();
    }

    public function postulationFor(Apero $apero)
    {
        return Postulation::where('apero_id', $apero->id)->where('user_id', $this->id)->first();
    }
}
