<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
     public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'ph_number' => 'required|regex:/^[0-9]{10}$/|unique:users,phone',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
        ]);
        
        $user = User::create([
            'name'     => $request->first_name . ' ' . $request->last_name,
            'email'    => $request->email,
            'phone'    => $request->ph_number,
            'role_id'  => 3,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
    }
}
