<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    public function create()
    {
        Auth::guard('web')->logout();
        return inertia('Auth/Login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        $remember = $request->input('remember', false);

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $dashboardRoute = 'dashboard';
            if ($user->isAdmin()) {
                $dashboardRoute = 'admin.dashboard';
            } elseif ($user->isInstructor()) {
                $dashboardRoute = 'instructor.dashboard';
            } elseif ($user->isMechanic()) {
                $dashboardRoute = 'mechanic.dashboard';
            } elseif ($user->isReseller()) {
                $dashboardRoute = 'reseller.dashboard';
            } else if ($user->isRegularUser()) {
                $dashboardRoute = 'dashboard';
            }

            return response()->json(['redirect' => route($dashboardRoute)]);
        }

        return response()->json(['password' => 'Incorrect password or email'], 422);

    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('dashboard');
    }
}
