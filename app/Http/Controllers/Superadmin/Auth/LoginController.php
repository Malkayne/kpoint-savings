<?php

namespace App\Http\Controllers\Superadmin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('superadmin')->check()) {
            return redirect()->route('superadmin.dashboard');
        }

        return view('superadmin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('superadmin.dashboard');
        }

        return back()
            ->withErrors(['username' => 'Invalid superadmin credentials.'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['acting_org_id', 'acting_as_superadmin']);

        Auth::guard('superadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');
    }
}
