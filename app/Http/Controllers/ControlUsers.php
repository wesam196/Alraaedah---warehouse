<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ControlUsers extends Controller
{
    public function index()
    {
        if(auth()->user()->usertype ==2){
        $users = User::all();
        return view('admin.control-users', ['users' => $users]);
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }

    public function update(Request $request, $id)
    {
        if(auth()->user()->usertype ==2){
        $user = User::findOrFail($id);
        $user->name = $user->name; // Keep the name unchanged
        $user->email =  $user->email;
        $user->usertype = $request->usertype; // Update usertype based on the form input
        $user->save();

        return redirect()->back()->with('msg', 'User updated successfully');
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }


    public function resetPassword($id)
    {
        if(auth()->user()->usertype ==2){
        $user = User::findOrFail($id);
        $user->password = bcrypt('admin'); // Set a default password
        $user->save();

        return redirect()->back()->with('msg', 'Password reset successfully');
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }

    public function delete($id)
    {
        if(auth()->user()->usertype ==2){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('msg', 'User deleted successfully');
    
        } else {
            abort(403, 'Access Denied'); // Return a 403 Forbidden response if the user does not have permission
        }
    }
    
    
    
}
