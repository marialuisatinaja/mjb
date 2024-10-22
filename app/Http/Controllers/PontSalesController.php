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
    public function package(Request $request)
    {
        $id = $request->input('id');
        $services = Package::find($id);
        $user = User::where('user_type','Therapist')->where('status','Active')->get();
        return view('pages.point.package', compact('services','user'));
    }
    
    public function index()
    {
        $services = Services::all();
        $packages = Package::all();
        $reservations = Reservation::with('services','package')
        ->where('offers_type', 'walkin')
        ->where(function ($query) {
            $query->where('status', 'Pending')
                  ->orWhere('status', 'Serving');
        })
        ->get();
        return view('pages.point.index', compact('services','packages','reservations'));
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
            'service_ids.*' => function ($attribute, $value, $fail) {
                // Check if the request contains service_ids and if there's only one item
                if (count(request()->input('service_ids', [])) === 1) {
                    return; // Skip validation if there's only one item
                }
        
                // Otherwise, check if the value exists in the services table
                if (!\DB::table('services')->where('id', $value)->exists()) {
                    $fail("The selected $attribute is invalid.");
                }
            },
        ]);
        
        
        $serviceIdsString = $validatedData['service_ids'][0]; // This will be "1,2"
        $serviceIdsArray = explode(',', $serviceIdsString); // This will create an array
        $serviceIdsArray = array_map('intval', $serviceIdsArray);

        $reservation = new Reservation();
        $reservation->service_id = $request->input('id_service');
        $reservation->service_type = $request->input('service_type');
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
        $reservation->date = now()->toDateString(); // Sets the date to today
        $reservation->time = now()->toTimeString(); // Sets the time to now
        $reservation->status = 'Serving';
        $reservation->offers_type = 'walkin';
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
