<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations  = Reservation::with('services')->where('status','Pending')->orwhere('status','Serving')->get();
        return view('pages.reservations.index',compact('reservations'));
    } 

    public function details(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $reservation  = Reservation::with('services')->where('id', $id)->first(); 
        $user = User::where('user_type','Therapist')->where('status','Active')->get();
        return view('pages.reservations.details',compact('reservation','status','user'));
    }

    public function updateDetails(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', // Adjust validation as needed
            'status' => 'required|string'
        ]);

 
    
        if($validatedData['status'] == 'Serving'){
            echo 'a';
        }else{
            $reservation->update([
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'status' => $validatedData['status'],
            ]);
        }
        
        return back()->with([
            'success' => 'Rescheduled successfully saved',
            'redirectUrl' => route('reservation.index') // Replace with your actual route
        ]);
    }
}
