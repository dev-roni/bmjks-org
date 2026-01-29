<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\LifetimeMemberValidation;
use App\Http\Requests\GeneralMemberValidation;
use App\Models\Person;
use App\Models\PersonType;
use App\Models\PersonTag;
use App\Models\CommitteeName;

class EServiceController extends Controller
{
    public function lifetime_member_application_view(){
        return view('frontend.pages.lifetime_member');
    }
    public function lifetime_member_store(LifetimeMemberValidation $request){
        $validdata = $request->validated();
        $validdata['member_aproved'] = 'no';
        $person = Person::create($validdata);
        PersonTag::create([
            'person_id'     => $person->id,
            'persontype_id' => 1
        ]);

        $msz ='জনাব '.$person->name.' আপনার আবেদনটি সফলভাবে গ্রহন করা হয়েছে । 
			    খুব শিগ্রই আপনার এই '.$person->mobile_number.' নাম্বারে যোগাযোগ করা হবে ।';

        return view('frontend.pages.application_success_msz')->with('msz',$msz);
    }

    public function general_member_application_view(){
        $committeeNames = CommitteeName::get();
        return view('frontend.pages.general_member', compact('committeeNames'));
    }

    public function general_member_store(GeneralMemberValidation $request)
    {
        $validdata = $request->validated();
        $validdata['member_aproved'] = 'no';

        // ====== প্রথমে ছবি হ্যান্ডেল করো ======
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/person'), $imageName);
            $validdata['photo'] = $imageName;
        } else {
            $validdata['photo'] = null;
        }

        $person = Person::create($validdata);

        PersonTag::create([
            'person_id'     => $person->id,
            'persontype_id' => 2
        ]);


        $msz ='জনাব '.$person->name.' আপনার আবেদনটি সফলভাবে গ্রহন করা হয়েছে । 
                    খুব শিগ্রই আপনার এই '.$person->mobile_number.' নাম্বারে যোগাযোগ করা হবে ।';

        return view('frontend.pages.application_success_msz')->with('msz',$msz);
    }

}
