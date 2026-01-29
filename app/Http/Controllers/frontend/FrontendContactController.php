<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ContactValidate;
use App\Models\Contact;

class FrontendContactController extends Controller {
    public function contact() {
        return view('frontend.pages.contact');
    }

    public function Store(ContactValidate $request) {
        $validateData = $request->validated();
        
        $contact = Contact::create([
            "name"          => $validateData['name'],
            "phone_no"      => $validateData['phone'],
            "email"         => $validateData['email'],
            "read_status"   => 'unread',
            "message_title" => $validateData['subject'],
            "message"       => $validateData['message'],
        ]);

        $msz ='জনাব '.$validateData['name'].' আপনার বার্তটি সফলভাবে গ্রহন করা হয়েছে । 
				খুব শিগ্রই আপনার এই '.$validateData['phone'].' নাম্বারে যোগাযোগ করা হবে ।';

        if(!$contact){
            return redirect()->back()->with('error', 'দুঃখিত! বার্তাটি পাঠানো সম্ভব হয়নি, পরে আবার চেষ্টা করুন।');
        }
        return view('frontend.pages.application_success_msz')->with('msz',$msz);
    }

}
