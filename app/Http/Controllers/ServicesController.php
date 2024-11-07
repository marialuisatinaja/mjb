<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\CreateServices;
use App\Http\Requests\Services\UpdateServices;
use App\Models\BusinessDetails;
use App\Models\Reservation;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
 
    public function service(Request $request)
    {
        $id = $request->input('id');
        $services = Services::findOrFail($id);
        return view('pages.reserved.service',compact('services','id'));
    }

    public function reserved($id)
    {
        $services = Services::where('id',$id)->get();
        return view('pages.reserved.index',compact('services','id'));
    }

    public function index()
    {
        $services = Services::all();
        return view('pages.services.index',compact('services'));
    }

    public function create()
    {
        return view('pages.services.create');
    }

    public function store(CreateServices $request)
    {
         // Handle image upload
         $imagePath = null;

         if ($request->hasFile('upload')) {
             $image = $request->file('upload');
             // Define the path to save the image in the public/images directory
             $destinationPath = public_path('services');
             
             // Ensure the directory exists
             if (!file_exists($destinationPath)) {
                 mkdir($destinationPath, 0777, true);
             }
             
             // Generate a unique file name and move the file
             $fileName = time() . '.' . $image->getClientOriginalExtension();
             $image->move($destinationPath, $fileName);
             
             // Set the image path to be used in the database
             $imagePath = 'services/' . $fileName;
         }
     
         // Create and save the course record
         $services = new Services();
         $services->title = $request->input('title');
         $services->type = $request->input('type');
         $services->amount = $request->input('amount');
         $services->hours = $request->input('hours');
         $services->minutes = $request->input('minutes');
         $services->description = $request->input('description');
         $services->upload = $imagePath; // Save the image path to the database
         $services->save();
     
         return response()->json([
             'message' => 'service save successfully.',
             'redirectUrl' => route('service.index') // URL to redirect to after deletion
         ]);
    }

    public function edit($id)
    {
        $services = Services::findOrFail($id);
        return view('pages.services.edit',compact('services'));
    }

    public function update(UpdateServices $request, $id)
    {
        $services = Services::findOrFail($id);

        // Handle image upload
        $imagePath = $services->upload; // Keep the existing image path

        if ($request->hasFile('upload')) {
            $image = $request->file('upload');
            
            // Define the path to save the image in the public/images directory
            $destinationPath = public_path('services');
            
            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Generate a unique file name and move the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);
            
            // Set the image path to be used in the database
            $imagePath = 'services/' . $fileName;

            // Optionally, delete the old image file if a new one is uploaded
            if ($services->upload && file_exists(public_path($services->upload))) {
                unlink(public_path($services->upload));
            }
        }

        // Update the course record
        $services->title = $request->input('title');
        $services->type = $request->input('type');
        $services->amount = $request->input('amount');
        $services->hours = $request->input('hours');
        $services->minutes = $request->input('minutes');
        $services->description = $request->input('description');
        $services->upload = $imagePath; // Save the image path to the database
        $services->save();

        return response()->json([
            'message' => 'Service updated successfully.',
            'redirectUrl' => route('service.index') // URL to redirect to after update
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $service = Services::find($id);
        $service->delete();
        return back()->with('success', 'Service successfully deleted');
    }

    public function reservation(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'type' => 'required|string|max:10',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50', 
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'phone' => ['required', 'string'],
        ]);
    
        if ($request->input('service_type') == 'package') {
            $reservation = new BusinessDetails();
            $reservation->first_name = $request->input('first_name');
            $reservation->middle_name = $request->input('middle_name');
            $reservation->last_name = $request->input('last_name');
            $reservation->gender = $request->input('gender');
            $reservation->email = $request->input('email');
            $reservation->phone = $request->input('phone');
            $reservation->type = $request->input('type');
            $reservation->preffered = $request->input('therapist_gender');
            $reservation->boy_therapist = $request->input('boy_therapist');
            $reservation->girl_therapist = $request->input('girl_therapist');
            $reservation->total_person = $request->input('total_person');
            $reservation->date = $request->input('date');
            $reservation->time = $request->input('time');
            $reservation->status = 'Pending';
            $reservation->offers_type = 'reservations';     
            $reservation->payment_total = $request->input('service_ammount');       
            $reservation->save();

            $details = new Reservation();
            $details->reservation_id = $reservation->id;
            $details->service_id = $request->input('service_id');
            $details->service_type = 'package';
            $details->save();

        }else{
            // Check if reservation is for 'self'
            if ($request->input('type') == 'self') {
                $reservation = new BusinessDetails();
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
                $reservation->date = $request->input('date');
                $reservation->time = $request->input('time');
                $reservation->status = 'Pending';
                $reservation->offers_type = 'reservations';
                $reservation->payment_total = $request->input('service_ammount');
                $reservation->save();

                $details = new Reservation();
                $details->reservation_id = $reservation->id;
                $details->service_id = $request->input('service_id');
                $details->service_type = 'services';
                $details->save();

            } else {
                $reservation = new BusinessDetails();
                $reservation->first_name = $request->input('first_name');
                $reservation->middle_name = $request->input('middle_name');
                $reservation->last_name = $request->input('last_name');
                $reservation->gender = $request->input('gender');
                $reservation->email = $request->input('email');
                $reservation->phone = $request->input('phone');
                $reservation->type = $request->input('type');
                $reservation->preffered = $request->input('therapist_gender');
                $reservation->boy_therapist = $request->input('boy_therapist');
                $reservation->girl_therapist = $request->input('girl_therapist');
                $reservation->total_person = $request->input('total_person');
                $reservation->date = $request->input('date');
                $reservation->time = $request->input('time');
                $reservation->status = 'Pending';
                $reservation->offers_type = 'reservations';
                $reservation->payment_total = $request->input('service_ammount') * $request->input('total_person');
                $reservation->save();


                $details = new Reservation();
                $details->reservation_id = $reservation->id;
                $details->service_id = $request->input('service_id');
                $details->service_type = 'services';
                $details->save();
            }
        }
        
        
        return back()->with([
            'success' => 'Details successfully reserved',
            'redirectUrl' => url()->previous()  // This gets the previous URL
        ]);
        

    }
    
    public function userReseravtion(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', 
            'service_type' => 'required',
            'service_ids' => 'exists:services,id' 
        ]);

            $user  = User::where('id', auth()->user()->id)->first(); 
            $serviceIdsArray = explode(',', $validatedData['service_ids'][0]); 
            $serviceTypeArray = explode(',', $validatedData['service_type'][0]); 

            $details = new BusinessDetails();
            $details->first_name = $user->first_name;
            $details->middle_name = $user->middle_name;
            $details->last_name = $user->last_name;
            $details->gender =$user->gender;
            $details->email = $user->email;
            $details->phone = $user->phone;
            $details->type = $request->input('type');
            $details->preffered = $request->input('therapist_gender');
            $details->total_person = ( $request->input('type') === 'self') ? 1 : $request->input('total_person');
            $details->boy_therapist = $request->input('boy_therapist');
            $details->girl_therapist = $request->input('girl_therapist');
            $details->date = $request->input('date');
            $details->time = $request->input('time');
            $details->payment_total = $request->input('payment_total');
            $details->status = 'Pending';
            $details->offers_type = 'reserved';
            $details->save();

            foreach ($serviceIdsArray as $index => $serviceId) {
                $serviceType = $serviceTypeArray[$index] ?? null;
                $reservation = new Reservation();
                $reservation->reservation_id = $details->id;
                $reservation->service_id = $serviceId;
                $reservation->service_type = $serviceType;
                $reservation->save();
            }

            return back()->with([
                'success' => 'Details successfully reserved',
                'redirectUrl' => url()->previous()  // This gets the previous URL
            ]);
        
    }

    public function userWalkin(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'time' => 'required|string', 
            'service_type' => 'required',
            'service_ids' => 'exists:services,id' 
        ]);

            $user  = User::where('id', auth()->user()->id)->first(); 
            $serviceIdsArray = explode(',', $validatedData['service_ids'][0]); 
            $serviceTypeArray = explode(',', $validatedData['service_type'][0]); 

            $details = new BusinessDetails();
            $details->first_name = $request->input('first_name');
            $details->middle_name = $request->input('middle_name');
            $details->last_name = $request->input('last_name');
            $details->email = $request->input('email');
            $details->phone = $request->input('phone');
            $details->type = $request->input('type');
            $details->preffered = $request->input('therapist_gender');
            $details->total_person = ( $request->input('type') === 'self') ? 1 : $request->input('total_person');
            $details->boy_therapist = $request->input('boy_therapist');
            $details->girl_therapist = $request->input('girl_therapist');
            $details->date = $request->input('date');
            $details->time = $request->input('time');
            $details->payment_total = $request->input('payment_total');
            $details->status = 'Pending';
            $details->offers_type = 'walkin';
            $details->save();

            foreach ($serviceIdsArray as $index => $serviceId) {
                $serviceType = $serviceTypeArray[$index] ?? null;
                $reservation = new Reservation();
                $reservation->reservation_id = $details->id;
                $reservation->service_id = $serviceId;
                $reservation->service_type = $serviceType;
                $reservation->save();
            }

            return back()->with([
                'success' => 'Details successfully reserved',
                'redirectUrl' => url()->previous()  // This gets the previous URL
            ]);
    }


}
