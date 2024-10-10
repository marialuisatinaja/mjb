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

 
}
