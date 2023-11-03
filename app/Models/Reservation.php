<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
    ];

    /**
     * Get the user that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the event that the reservation is for.
     */
    public function event()
    {
        return $this->belongsTo('App\Models\Event');
    }

    /**
     * Get the tickets for the reservation.
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    // You can add more relationships and methods as needed
}
