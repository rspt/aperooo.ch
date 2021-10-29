<?php

namespace App\Models;

use Carbon\Carbon;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Apero extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'start',
        'address',
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
        return $this->belongsToMany(User::class)->using(Postulation::class)->withPivot(['id', 'status'])->as('postulation');
    }

    public function getStartFormAttribute()
    {
        return Carbon::parse($this->start)->format('Y-m-d\TH:i');
    }
}
