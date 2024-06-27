<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } else {

            return view('admin.login');
        }
    }
    public function login_checking(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string|min:3|max:20'
        ]);
        $email = filter_var($request->input('email'), FILTER_SANITIZE_EMAIL);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);
        $username = $email;
        $admin = AdminModel::where('username', $username)->first();
        if ($admin) {
            if ($password === $admin->password) {
                Auth::guard('admin')->login($admin);

                return redirect()->route('admin.dashboard');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password');
        }
    }

    public function admin_dashboard()
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }
        $active = "dashboard";
        return view('admin.dashboard', compact('active'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
