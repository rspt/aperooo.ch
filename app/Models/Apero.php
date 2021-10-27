<?php

namespace App\Models;

use Carbon\Carbon;

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

    public function getStartFormAttribute()
    {
        return Carbon::parse($this->start)->format('Y-m-d\TH:i');
    }
}
