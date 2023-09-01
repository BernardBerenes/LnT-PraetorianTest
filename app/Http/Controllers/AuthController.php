<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register_menu(){
        return view('Auth.register');
    }

    public function register(Request $request){
        $request->validate([
            'full_name' => 'required|string|min:3|max:40',
            'email' => 'required|string|ends_with:@gmail.com',
            'password' => 'required|string|min:6|max:12',
            'phone_number' => 'required|string|starts_with:08'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number
        ]);

        return redirect(route('item'));
    }

    public function login_menu(){
        return view('Auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended(route('item'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->onlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('item'));
    }
}
