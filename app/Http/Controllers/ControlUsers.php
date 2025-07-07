<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class ControlUsers extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.control-users', ['users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $user->name; // Keep the name unchanged
        $user->email =  $user->email;
        $user->usertype = $request->usertype; // Update usertype based on the form input
        $user->save();

        return redirect()->back()->with('msg', 'User updated successfully');
    }


    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = bcrypt('admin'); // Set a default password
        $user->save();

        return redirect()->back()->with('msg', 'Password reset successfully');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('msg', 'User deleted successfully');
    }
    
}
