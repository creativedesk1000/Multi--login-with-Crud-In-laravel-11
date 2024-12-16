<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
   
    public function create()
    {
        return view('admin.create'); // Ensure this matches your create.blade.php file
    }

    // Store the new user
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
        ]);

        try {
            // Create the user
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')), // Hash the password
                'role' => $request->input('role'),
            ]);

            return redirect('/admin/dashboard')->with('success', 'User Added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add user. Please try again.');
        }
    }
   
   
   
   
    public function edit(User $user)
    {
        return view('admin.edit', compact('user')); // Correct path to the admin folder
    }

    // Handle the update form (if you have a form to save changes)
    public function update(Request $request, User $user)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
        ]);

        try {
            // Update the user details
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
            ]);

            
            return redirect('/admin/dashboard')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect('/admin/dashboard')->with('error', 'Failed to update user. Please try again.');
        }
    }



    public function destroy(User $user)
    {
        try {
            $user->delete(); 
            return redirect('/admin/dashboard')->with('success', 'User deleted successfully.');
            
        } catch (\Exception $e) {
            return redirect('/admin/dashboard')->with('error', 'Failed to delete user.');
        }
    }
    
}
