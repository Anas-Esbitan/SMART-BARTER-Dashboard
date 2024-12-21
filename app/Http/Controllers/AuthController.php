<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Admin;

class AuthController extends Controller
{
    
    public function showUserRegisterForm()
    {
        return view('auth.user-register');
    }

    public function userRegister(Request $request)
    {
        $request->validate([
            'First_Name' => 'required|string|max:255',
            'Last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'First_Name' => $request->First_Name,
            'Last_name' => $request->Last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user', 
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully!');
    }


    public function showAdminRegisterForm()
    {
        return view('auth.admin-register');
    }


    public function adminRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin registered successfully!');
    }


    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return redirect()->route('/');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }


    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        } else {
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }
    }
}