<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    public function create() {
        return inertia('Auth/Register');
    }
    public function store(Request $request) {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            // 'terms' => 'accepted',
        ]);

        // Create new user
        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'role' => 'user',
            'password' => $credentials['password'],
        ]);

        // Log in the new user
        //Auth::guard('web')->login($user, true);  // The 'true' sets the "remember me" token
        //$request->session()->regenerate();

        return $user;
    }
}