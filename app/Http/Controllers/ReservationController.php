<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not allowed to view this reservation.');
        }

        return view('reservation.index', [
            'reservation' => $reservation
        ]);
    }

    public function checkout(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'ticket_count' => 'required|integer|min:1'
        ]);

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->user_id = Auth::id();
        $reservation->event_id = $validated['event_id'];
        $reservation->save();

        // Create tickets for the reservation
        for ($i = 0; $i < $validated['ticket_count']; $i++) {
            $ticket = new Ticket();
            $ticket->reservation_id = $reservation->id;
            $ticket->save();
        }

        // Redirect with success message
        return redirect()->route('reservation.show', $reservation);
    }
}