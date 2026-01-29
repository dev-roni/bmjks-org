<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\CommitteeName;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller {
    public function users(){
        $users = User::with('committeeName')->get();
        return view('Backend.Pages.Users-Manage', compact('users'));
    }

    public function userStore(AccountValidate $request){
        $validateData = $request->validated();

        $user = User::create([
            "name"           => $validateData['name'],
            "username"       => $validateData['username'],
            "phone_no"       => $validateData['phone_no'],
            "branch"         => $validateData['branch'],
            "account_type"   => $validateData['account_type'],
            "password"       => Hash::make($validateData['password']),
        ]);

        if(!$user){
            return redirect()->back()
                             ->with("error", "দুঃখিত! অ্যাকাউন্ট সংরক্ষণ করতে ব্যর্থ হয়েছে।");
        }
        return redirect()->back()
                         ->with("success", "অ্যাকাউন্ট সফলভাবে সংরক্ষণ করা হয়েছে।");
    }

    public function passwordUpdate(Request $request, $id){
        $validated = $request->validate([
            "password"     => "required|min:8|max:20|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|confirmed",
        ],[
            "password.required"  => "পাসওয়ার্ড অবশ্যই দিতে হবে।",
            "password.min"       => "পাসওয়ার্ড অন্তত ৮ অক্ষরের হতে হবে।",
            "password.max"       => "পাসওয়ার্ড সর্বাধিক ২০ অক্ষরের হতে পারবে।",
            "password.confirmed" => "পাসওয়ার্ড এবং নিশ্চিত পাসওয়ার্ড মিলছে না।",
            'password.regex'     => 'পাসওয়ার্ডে অন্তত একটি বড় হাতের অক্ষর, একটি ছোট হাতের অক্ষর এবং একটি সংখ্যা থাকতে হবে।',
        ]);

        $user = User::find($id);
        if(!$user){
            return redirect()->back()
                            ->with("error", "দুঃখিত! নির্দিষ্ট অ্যাকাউন্টটি খুঁজে পাওয়া যায়নি।");
        }

        $user->update([
            "password" => Hash::make($validated['password']),
        ]);

        return redirect()->back()
                         ->with("success", "পাসওয়ার্ডে সফলভাবে আপডেট করা হয়েছে।");
    }

    public function userDestroy(Request $request, $id){
        $account = User::find($id);

        if(!$account){
            return redirect()->back()
                             ->with("error", "অ্যাকাউন্ট খুঁজে পাওয়া যায়নি।");
        }

        if(Auth::user()->id == $account->id ){
            return redirect()->back()->with("error", "অ্যাকাউন্টটি ডিলিট করা যাবে না");
        }

        $account->delete();

        return redirect()->back()
                         ->with("success", "অ্যাকাউন্ট সফলভাবে মুছে ফেলা হয়েছে।");
    }
}
