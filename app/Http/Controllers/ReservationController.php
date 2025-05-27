<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function userReservations()
    {
        $user = Auth::user();
        $reservations = Reservation::where('user_id', $user->id)->get();
        return view('reservations.reservations', [
            'reservations' => $reservations
        ]);
    }

    public function create($service_id)
    {
        return view('reservations.create', [
            'service_id' => $service_id
        ]);
    }

    public function createSubmit(Request $request, $service_id)
    {
        $validated = $request->validate([
            'car_brand' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_plate' => 'required|string|max:50',
            'note' => 'nullable|string',
            'scheduled_at' => 'required|date|after:now',
        ]);

        $user = Auth::user();

        Reservation::create([
            'service_id' => $service_id,
            'user_id' => $user->id,
            'car_brand' => $validated['car_brand'],
            'car_model' => $validated['car_model'],
            'car_plate' => $validated['car_plate'],
            'note' => $validated['note'] ?? null,
            'scheduled_at' => $validated['scheduled_at'],
        ]);

        return redirect()->route('reservations.userReservations')
                        ->with('success', 'Uspešno ste zakazali termin!');
    }
}
