<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index()
    {
        // Historical reservations: events before today and tickets are scanned
        $historicalReservations = Reservation::where('user_id', Auth::id())
            ->whereHas('event', function ($query) {
                $query->where('date', '<', now());
            })
            ->whereHas('tickets', function ($query) {
                $query->where('gescand', true);
            })
            ->with([
                'event' => function ($query) {
                    $query->orderBy('date', 'desc');
                }
            ])
            ->get();

        // Expired reservations: events before today and tickets are not scanned
        $expiredReservations = Reservation::where('user_id', Auth::id())
            ->whereHas('event', function ($query) {
                $query->where('date', '<', now());
            })
            ->whereDoesntHave('tickets', function ($query) {
                $query->where('gescand', true);
            })
            ->with([
                'event' => function ($query) {
                    $query->orderBy('date', 'desc');
                }
            ])
            ->get();

        // Future reservations: events after today
        $futureReservations = Reservation::where('user_id', Auth::id())
            ->whereHas('event', function ($query) {
                $query->where('date', '>', now());
            })
            ->with([
                'event' => function ($query) {
                    $query->orderBy('date', 'desc');
                }
            ])
            ->get();

        return view('reservation.all', [
            'historical' => $historicalReservations,
            'expired' => $expiredReservations,
            'future' => $futureReservations,
        ]);
    }

    public function show(Reservation $reservation)
    {
        if ($reservation->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not allowed to view this reservation.');
        }

        return view('reservation.reservation', [
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

        return redirect()->route('reservation.reservation', $reservation);
    }
}