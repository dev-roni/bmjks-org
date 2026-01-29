<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommitteeYear;
use App\Models\CommitteeName;
use App\Models\CommitteeMember;
use App\Http\Requests\CommitteeYearValidation;

class CommitteeYearController extends Controller {
    public function committeeYearCreate(CommitteeYearValidation $request){
        $validateData = $request->validated();   

        $committeeData = new CommitteeYear();
        $committeeData->committee_id = $validateData['committee_id'];
        $committeeData->committee_name = $validateData['committee_year_name'];
        $committeeData->committee_start_date = $validateData['start_date'];
        $committeeData->status = 'active';
        if($committeeData->save()){
            CommitteeYear::where('committee_id', $committeeData->committee_id)
                         ->where('id', '!=', $committeeData->id)
                         ->update(['status' => 'deactive']);

            $previousId = CommitteeYear::where('id', '<', $committeeData->id)
                            ->where('committee_id', $committeeData->committee_id)
                            ->where('id', '!=', $committeeData->id)
                            ->latest('id')
                            ->first();

            if($previousId){
                $previousId->committee_end_date = $validateData['start_date'];
                $previousId->save();
            }

            return redirect()->back()
                             ->with('success','কমিটি সফলভাবে তৈরি হয়েছে');
        }
        return redirect()->back()
                         ->with('error','কমিটি তৈরি ব্যার্থ হয়েছে');
    }

    public function activeCommittee($id){
        // $committeeMember = CommitteeMember::where('CommitteeYear_id', $id)->orderBy('role', 'asc')->get();
        // $committeeName = CommitteeYear::where('id', $id)->first();
        $committeeYear = CommitteeYear::with(['committee_members' => function($query) {
            $query->orderBy('role', 'asc');
        }])->find($id);
        return view('Backend.Pages.Committee-Member-List', compact('committeeYear', 'id'));
    }
}
