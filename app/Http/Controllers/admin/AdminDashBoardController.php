<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminDashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function groupChat() {
        
        return view('admin.chat');
    }

    public function addUser() {
        return view('admin.addUser');
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
            'password' => Hash::make($validated['password']),
        ]);


        return redirect()->back()->with('success', 'User Created successfully!');
    }

    public function usersList() {
        $users = User::where('role_id',2)->get();
        
        return view('admin.chat' , compact('users'));
    
    
    }




}
