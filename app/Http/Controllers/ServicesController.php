<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Services\CreateServices;
use App\Http\Requests\Services\UpdateServices;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
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
        $service = Services::findOrFail($id);

        // Handle image upload
        $imagePath = $service->upload; // Keep the existing image path

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
        $service->title = $request->input('title');
        $service->type = $request->input('type');
        $service->amount = $request->input('amount');
        $service->description = $request->input('description');
        $service->upload = $imagePath; // Save the image path to the database
        $service->save();

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

}
