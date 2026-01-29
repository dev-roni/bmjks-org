<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\President;
use Illuminate\Http\Request;

class PresidentController extends Controller
{
    public function create_view()
    {
        $president = President::latest()->first();
        return view('Backend.Pages.President',compact('president'));
    }
    
    public function update(Request $request, $id)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'message' => 'required|string|max:2000',
                'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'name.required' => 'সভাপতির নাম দিতে হবে।',
                'name.string' => 'নাম অবশ্যই লেখার আকারে হতে হবে।',
                'name.max' => 'নাম সর্বোচ্চ ২৫৫ অক্ষরের মধ্যে হতে হবে।',

                'message.required' => 'বার্তা অবশ্যই দিতে হবে।',
                'message.string' => 'বার্তাটি সঠিকভাবে লিখুন।',
                'message.max' => 'বার্তা সর্বোচ্চ ২০০০ অক্ষর হতে পারবে।',

                'photo.image' => 'ছবিটি অবশ্যই ইমেজ হতে হবে।',
                'photo.mimes' => 'ছবির ফরম্যাট JPG, JPEG বা PNG হতে হবে।',
                'photo.max' => 'ছবির আকার ২MB এর বেশি হতে পারবে না।',
            ]);

            $presidentData = President::findOrFail($id);
            $presidentData->name = $validated['name'];
            $presidentData->message = $validated['message'];

            if ($request->hasFile('photo')) {
                // পুরোনো ফটো থাকলে মুছে ফেলো
                if ($presidentData->photo && file_exists(public_path('uploads/president/' . $presidentData->photo))) {
                    unlink(public_path('uploads/president/' . $presidentData->photo));
                }

                // নতুন ফটো আপলোড
                $file = $request->file('photo');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/president'), $filename);

                // নতুন ফটো সেট করা
                $presidentData->photo = $filename;
            }

            $presidentData->save();
            return redirect()->back()->with('success', 'সভাপতির তথ্য সফলভাবে হালনাগাদ হয়েছে!');
        }


}
