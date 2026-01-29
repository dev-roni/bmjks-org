<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactUnread(){
        $contacts = Contact::where('read_status', 'unread')->paginate(10);
        return view('Backend.Pages.Contact', compact('contacts'));
    }

    public function contactRead(){
        $contacts = Contact::where('read_status', 'read')->paginate(10);
        return view('Backend.Pages.Contact', compact('contacts'));
    }

    public function readConfirm($id){
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->back()
                            ->with("error", "দুঃখিত! অনুরোধকৃত কন্টাক্ট রেকর্ডটি খুঁজে পাওয়া যায়নি।");
        }

        $contact->update([
            "read_status" => "read",
        ]);

        return redirect()->back()
                        ->with("success", "কন্টাক্ট রেকর্ডটি সফলভাবে দেখা হয়েছে হিসেবে চিহ্নিত করা হয়েছে।");
    }

    public function unreadConfirm($id){
        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->back()
                            ->with("error", "দুঃখিত! অনুরোধকৃত কন্টাক্ট রেকর্ডটি খুঁজে পাওয়া যায়নি।");
        }

        $contact->update([
            "read_status" => "unread",
        ]);

        return redirect()->back()
                        ->with("success", "কন্টাক্ট রেকর্ডটি দেখা হয়নি হিসেবে চিহ্নিত করা হয়েছে।");
    }

}
