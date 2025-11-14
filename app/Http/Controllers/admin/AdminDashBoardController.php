<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function groupChat() {
        return view('admin.chat');
    }

    public function addUser() {
        return view('admin.userList');
    }

    public function addUserStore(Request $request)  {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => 'user',
            'role_id' => '2',
            'password' => $validated['password'],
            'hashed_password' => Hash::make($validated['password']),
        ]);
         return redirect()->route('admin.user.list')->with('success', 'User Created successfully!'); 
    }

    public function usersList() {
        $users = User::where('role_id',2)->get();        
        return view('admin.userList' , compact('users'));
    }
}
