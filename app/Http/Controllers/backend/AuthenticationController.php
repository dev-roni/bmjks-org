<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller{

    public function showLoginFrom(){
        return view('Backend.Auth.Login');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required' => 'ইউজারনেম ফিল্ড পূরণ করা আবশ্যক।',
            'password.required' => 'পাসওয়ার্ড ফিল্ড পূরণ করা আবশ্যক।',
        ]);

        if(Auth::attempt([
            "username" => $validated["username"],
            "password" => $validated["password"],
        ])){
            return redirect()->route("dashboard")
                            ->with("success", "আপনি সফলভাবে লগইন করেছেন।");
        }

        return redirect()->back()
                         ->with("error", "প্রদত্ত তথ্য সঠিক নয়। অনুগ্রহ করে আবার চেষ্টা করুন।");
    }

    public function logout(Request $request){
        Auth::logout(); // Log out the user
        $request->session()->invalidate();  // Clear all session data
        $request->session()->regenerateToken(); // Regenerate CSRF token
        return redirect()->route('login')
                         ->with("success", "আপনি সফলভাবে লগআউট হয়েছেন!");
    }
}
