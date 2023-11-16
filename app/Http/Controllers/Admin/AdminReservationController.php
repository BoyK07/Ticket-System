<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class AdminReservationController extends Controller
{
    public function show()
    {
        $reservations = Reservation::all();
        return view('admin.reservations.index')->with('reservations', $reservations);
    }

    public function delete(Reservation $reservation)
    {
        if (!Auth::user()->isAdmin) {
            abort(403, 'Unauthorized action.');
        }

        // Delete tickets associated with the reservation
        foreach ($reservation->tickets as $ticket) {
            $ticket->delete();
        }

        // Delete the reservation itself
        $reservation->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Verwijdering voltooid.');
    }

    public function resetScan(Reservation $reservation)
    {
        // Check if the user is authorized to reset the scan
        if (!Auth::user()->isAdmin) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Update the 'gescand' status
        foreach ($reservation->tickets as $ticket) {
            $ticket->gescand = false;
            $ticket->save();
        }
    }
}
