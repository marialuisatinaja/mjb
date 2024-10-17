<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Reservation;
use App\Models\SalesDetails;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;

class PontSalesController extends Controller
{
    public function index()
    {
        $services = Services::all();
        $packages = Package::all();
        return view('pages.point.index', compact('services','packages'));
    }

    public function create()
    {
        $services = Services::all();
        $packages = Package::all();
        return view('pages.point.create', compact('services','packages'));
    }

    public function details(Request $request)
    {
        $id = $request->input('id');
        $services = Services::find($id);
        $user = User::where('user_type','Therapist')->where('status','Active')->get();
        return view('pages.point.details', compact('services','user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'service_ids' => 'nullable|array', 
            'service_ids.*' => 'exists:services,id' 
        ]);

        $serviceIdsString = $validatedData['service_ids'][0]; // This will be "1,2"
        $serviceIdsArray = explode(',', $serviceIdsString); // This will create an array
        $serviceIdsArray = array_map('intval', $serviceIdsArray);

        $reservation = new Reservation();
        $reservation->service_id = $request->input('service_id');
        $reservation->service_type = 'walkin';
        $reservation->first_name = $request->input('first_name');
        $reservation->middle_name = $request->input('middle_name');
        $reservation->last_name = $request->input('last_name');
        $reservation->gender = $request->input('gender');
        $reservation->email = $request->input('email');
        $reservation->phone = $request->input('phone');
        $reservation->type = $request->input('type');
        $reservation->preffered = $request->input('therapist_gender');
        $reservation->boy_therapist = $request->input('therapist_gender') == 'girl' ? 0 : 1;
        $reservation->girl_therapist = $request->input('therapist_gender') == 'girl' ? 1 : 0;
        $reservation->total_person = 1;
        $reservation->message = $request->input('message');
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->status = 'Pending';
        $reservation->save();

        
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

                
        return back()->with([
            'success' => 'Details successfully reserved',
            'redirectUrl' => url()->previous()  // This gets the previous URL
        ]);
    }
}
