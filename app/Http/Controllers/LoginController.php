<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt login for regular users
        if (Auth::attempt($credentials)) {
            return redirect()->route('books');
        }

        // Attempt login for students using student guard
        $student = Student::where('id_number', $request->email)->first();
        if ($student && Hash::check($request->password, $student->password)) {
            Auth::guard('student')->login($student);
            return redirect()->route('book');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout(Request $request)
    {
        if (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
        } else {
            Auth::logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
