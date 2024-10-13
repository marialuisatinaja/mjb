<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations  = Reservation::with('services')->get();

        return view('pages.reservations.index',compact('reservations'));
    } 

    public function details(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $reservation  = Reservation::with('services')->where('id', $id)->first(); 
        return view('pages.reservations.details',compact('reservation','status'));
    }

    public function updateDetails(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', // Adjust validation as needed
            'status' => 'required|string'
        ]);

        $reservation->update([
            'date' => $validatedData['date'],
            'time' => $validatedData['time'],
            'status' => $validatedData['status'],
        ]);
    

        return back()->with([
            'success' => 'Rescheduled successfully saved',
            'redirectUrl' => route('reservation.index') // Replace with your actual route
        ]);
    }
}
