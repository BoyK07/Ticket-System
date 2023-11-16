<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reservation_id', // Assuming you want this to be mass assignable
        'gescand',
    ];

    /**
     * Get the reservation that the ticket belongs to.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // If you have additional methods or relationships, you can define them here
}