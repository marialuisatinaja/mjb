<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('services')
        ->where('status', '!=', 'Pending')
        ->get();

        return view('pages.sales.index',compact('reservations'));
    }  
}
