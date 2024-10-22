<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\SalesDetails;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function notification()
    {
        $walkinQuery = Reservation::with('services', 'package')
        ->where('status', 'Pending')
        ->where('offers_type', 'reservations');

    $reservationsCount = $walkinQuery->count();
    $reservations = $walkinQuery->get();

    return response()->json([
        'count' => $reservationsCount,
        'data' => $reservations
    ]);
    }

    public function index()
    {
        if(auth()->user()->user_type == 'Customer')
        {
            $reservations = Reservation::with('services','package')
            ->where('email',auth()->user()->email)->get();
            return view('pages.reservations.index', compact('reservations'));
        }else{
            $reservations = Reservation::with('services','package')
            ->where('offers_type', '<>', 'walkin')
            ->where(function ($query) {
                $query->where('status', 'Pending')
                      ->orWhere('status', 'Serving');
            })
            ->get();
            return view('pages.reservations.index', compact('reservations'));
        }
     
    } 

    public function details(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $reservation  = Reservation::with('services','package')->where('id', $id)->first(); 
        $user = User::where('user_type','Therapist')->where('status','Active')->get();
        return view('pages.reservations.details',compact('reservation','status','user'));
    }

    public function deleteReservation(Request $request)
    {
        $id = $request->input('id');
        $service = Reservation::find($id);
        $service->delete();
        return back()->with('success', 'Service successfully deleted');
    }

    public function edit_details(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');
        $email = $request->input('email');
        $reservation  = Reservation::with('services','package')->where('id', $id)->first(); 
        $details = SalesDetails::with('user')
        ->where('reservation_id', $id)
        ->where('email', $email)
        ->get();
        return view('pages.reservations.edit_details',compact('reservation','status','details'));
    }
    
    public function updateDetails(Request $request, $id)
    {

        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', // Adjust validation as needed
            'status' => 'required|string',
            'service_ids' => 'nullable|array', 
            'service_ids.*' => 'exists:services,id' 
        ]);

 
     
    
        if($validatedData['status'] == 'Serving'){
            $serviceIdsString = $validatedData['service_ids'][0]; // This will be "1,2"
            $serviceIdsArray = explode(',', $serviceIdsString); // This will create an array
            $serviceIdsArray = array_map('intval', $serviceIdsArray);

            foreach($serviceIdsArray as $row)
            {
                $packs = New  SalesDetails();
                $packs->reservation_id = $reservation->id;
                $packs->email = $reservation->email;
                $packs->therapist_id =  $row;
                $packs->save();

                $user = User::findOrFail($row);
                $user->status = 'Serving';
                $user->save();
            }

            $reservation->update([
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'status' => $validatedData['status'],
            ]);
            
        }else if($validatedData['status'] == 'Paid'){
        
       
            $details = SalesDetails::with('user')
            ->where('reservation_id', $id)
            ->where('email', $reservation->email)
            ->get();
        
        foreach($details as $row){
            $user = User::findOrFail($row->therapist_id); // Access the user_id from the row
            $user->status = 'Active';
            $user->save();
        }
        
            $reservation->update([
                'date' => $validatedData['date'],
                'time' => $validatedData['time'],
                'status' => $validatedData['status'],
            ]);

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
