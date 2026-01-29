<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\CommitteeMember;
use App\Models\CommitteeYear;
use Illuminate\Http\Request;
use App\Http\Requests\CommitteeMemberCreateValidate;
use App\Http\Requests\CommitteeMemberUpdateValidate;

class CommitteeMemberController extends Controller {

    public function index()
    {
        //
    }

    public function create() {
        //
    }

    public function store(CommitteeMemberCreateValidate $request) {
        $validateData = $request->validated();

        $committeeData = CommitteeYear::where('id', $validateData['CommitteeYear_id'])->first();
        if($committeeData->status == 'active'){
            
            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/members'), $imageName);
                $validateData['photo'] = 'uploads/members/' . $imageName;
            }

            if(CommitteeMember::create($validateData)){
                return redirect()->back()
                                 ->with('success', 'সদস্য সফলভাবে সংরক্ষণ করা হয়েছে!');
            }
        }
        else{
            return redirect()->back()
                             ->with("error", "নিষ্ক্রিয় কমিটিতে নতুন সদস্য যোগ করা যাবে না।");
        }

        return redirect()->back()
                         ->with('error', 'সদস্য সংরক্ষণ করতে ব্যর্থ হয়েছে।');
    }

    public function show(CommitteeMember $committeeMember)
    {
        //
    }

    public function edit(CommitteeMember $committeeMember)
    {
        //
    }

    public function update(CommitteeMemberUpdateValidate $request, CommitteeMember $committeeMember) {
        $data = $request->validated();

        if ($request->hasFile('photo')) {

            if ($committeeMember->photo && file_exists(public_path($committeeMember->photo))) {
                unlink(public_path($committeeMember->photo));
            }

            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/members'), $imageName);

            $data['photo'] = 'uploads/members/' . $imageName;
        }

        if ($committeeMember->update($data)) {
            return redirect()->back()
                            ->with('success', 'সদস্যের তথ্য সফলভাবে আপডেট হয়েছে');
        }

        return redirect()->back()
                        ->with('error', 'আপডেট ব্যর্থ হয়েছে।');
    }

    public function destroy(CommitteeMember $committeeMember) {
        if (!$committeeMember) {
            return redirect()->back()
                             ->with("error", "অনুরোধকৃত তথ্য খুঁজে পাওয়া যায়নি।");
        }

        $committeeMember->delete();
        return redirect()->back()
                         ->with("success", "সদস্য সফলভাবে মুছে ফেলা হয়েছে।");
    }
}
