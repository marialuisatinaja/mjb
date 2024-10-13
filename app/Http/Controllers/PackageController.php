<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageServices;
use App\Models\Services;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function package(Request $request)
    {
        $id = $request->input('id');
        $packages = Package::findOrFail($id);
        $svs = PackageServices::with('services')->where('package_id',$packages->id)->get();
        return view('pages.reservations.package',compact('packages','svs'));
    }

    public function index()
    {
        $packages = Package::all();
        return view('pages.packages.index',compact('packages'));
    }  

    public function create()
    {
        $services = Services::all();
        return view('pages.packages.create',compact('services'));
    }

    public function data(Request $request)
    {
        $id = $request->input('id');
        echo $id;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'persons' => 'required|numeric',
            'hours' => 'required|numeric',
            'upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'nullable|string|max:255',
            'service_ids' => 'required|array', 
            'service_ids.*' => 'exists:services,id' 
        ]);
    
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filePath = $file->store('uploads/packages', 'public'); 
            $validatedData['upload'] = $filePath; 
        }
    
        // Accessing the first element of the array and splitting it into an array
        $serviceIdsString = $validatedData['service_ids'][0]; // This will be "1,2"
        $serviceIdsArray = explode(',', $serviceIdsString); // This will create an array

        // Optionally, you can map the array elements to integers if needed
        $serviceIdsArray = array_map('intval', $serviceIdsArray);

        // Print the resulting array


        $package = Package::create([
            'name' => $validatedData['name'],
            'amount' => $validatedData['amount'],
            'hours' => $validatedData['hours'] ?? null, // Include upload if it exists
            'upload' => $validatedData['upload'] ?? null, // Include upload if it exists
            'description' => $validatedData['description'] ?? null, // Include upload if it exists
            'persons' => $validatedData['persons'],
        ]);

        foreach($serviceIdsArray as $row)
        {
            $packs = New  PackageServices();
            $packs->package_id = $package->id;
            $packs->service_id =  $row;
            $packs->save();
        }
     
        return response()->json([
            'message' => 'package save successfully.',
            'redirectUrl' => route('package.index') // URL to redirect to after deletion
        ]);

    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'hours' => 'required|numeric',
            'persons' => 'required|numeric',
            'upload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'nullable|string|max:255',
        ]);

        $package = Package::findOrFail($id);
        $package->update($validatedData);

        return response()->json([
            'message' => 'package updated successfully.',
            'redirectUrl' => route('package.index') // URL to redirect to after deletion
        ]);
    }

    public function edit($id)
    {
        $services = Services::all();
        $packages = Package::findOrFail($id);
        $svs = PackageServices::with('services')->where('package_id',$id)->get();
        return view('pages.packages.edit',compact('packages','services','svs'));
    }

    public function delServe(Request $request)
    {
        $id = $request->input('id');
        $service = PackageServices::find($id);
        $service->delete();
        return back()->with('success', 'Service successfully deleted');
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $package = Package::find($id);
        $package->delete();
        return back()->with('success', 'Package successfully deleted');
    }
}
