<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time',
        'location',
        'description',
        'price',
        'image',
    ];

    /**
     * Get the reservations for the event.
     */
    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation');
    }

    // You can add more relationships and methods as needed
}
