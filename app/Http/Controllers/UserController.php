<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUser;
use App\Http\Requests\User\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('pages.users.index',compact('users'));
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function store(CreateUser  $request)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Define the path to save the image in the public/images directory
            $destinationPath = public_path('user');
            
            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Generate a unique file name and move the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);
            
            // Set the image path to be used in the database
            $imagePath = 'user/' . $fileName;
        }
    
        // Create and save the course record
        $uer = new User();
        $uer->first_name = $request->input('first_name');
        $uer->middle_name = $request->input('middle_name');
        $uer->last_name = $request->input('last_name');
        $uer->gender = $request->input('gender');
        $uer->birth_date = $request->input('birth_date');
        $uer->user_type = $request->input('user_type');
        $uer->phone = $request->input('phone');
        $uer->email = $request->input('email');
        $uer->password = $request->input('password');
        $uer->image = $imagePath; // Save the image path to the database
        $uer->address = $request->input('address');
        $uer->status = 'Active';
        $uer->save();
    
        return response()->json([
            'message' => 'User save successfully.',
            'redirectUrl' => route('user.index') // URL to redirect to after deletion
        ]);

    }

    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('pages.users.edit',compact('users'));
    }

    public function update(UpdateUser $request, User $user)
    {
        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // Define the path to save the image in the public/images directory
            $destinationPath = public_path('user');
            
            // Ensure the directory exists
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            
            // Generate a unique file name and move the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);
            
            // Set the image path to be used in the database
            $imagePath = 'user/' . $fileName;
        }
    

        if($request->input('password')){
            $user->first_name = $request->input('first_name');
            $user->middle_name = $request->input('middle_name');
            $user->last_name = $request->input('last_name');
            $user->gender = $request->input('gender');
            $user->birth_date = $request->input('birth_date');
            $user->user_type = $request->input('user_type');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->image = $imagePath; // Save the image path to the database
            $user->address = $request->input('address');
            $user->save();
        }else{
            $user->first_name = $request->input('first_name');
            $user->middle_name = $request->input('middle_name');
            $user->last_name = $request->input('last_name');
            $user->gender = $request->input('gender');
            $user->birth_date = $request->input('birth_date');
            $user->user_type = $request->input('user_type');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->image = $imagePath; // Save the image path to the database
            $user->address = $request->input('address');
            $user->save();
        }

        return response()->json([
            'message' => 'User updated successfully.',
            'redirectUrl' => route('user.index') // URL to redirect to after deletion
        ]);
    }

    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $user = User::findOrFail($id); // Fetch the agency by ID
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }

}
