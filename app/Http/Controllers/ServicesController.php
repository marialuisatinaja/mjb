<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\CreateServices;
use App\Http\Requests\Services\UpdateServices;
use App\Models\Reservation;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
 
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
            if ($service->upload && file_exists(public_path($service->upload))) {
                unlink(public_path($service->upload));
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
    
        // Check if reservation is for 'self'
        if ($request->input('type') == 'self') {
            $reservation = new Reservation();
            $reservation->service_id = $request->input('service_id');
            $reservation->service_type = 'services';
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
        } else {
            $reservation = new Reservation();
            $reservation->service_id = $request->input('service_id');
            $reservation->service_type = 'services';
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
            $reservation->message = $request->input('message');
            $reservation->date = $request->input('date');
            $reservation->time = $request->input('time');
            $reservation->status = 'Pending';
            $reservation->save();
        }
    
        return back()->with('success', 'Details successfully reserved');
    }
    


}
