<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CommitteeActivitie;
use App\Models\CommitteeYear;
use App\Http\Requests\CommitteeActivitiesValidate;
use App\Http\Requests\CommitteeActivitiesEdit;
use Illuminate\Http\Request;

class CommitteeActivitieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $committeeYears = CommitteeYear::when(Auth::user()->branch != 100, function($query) {
            $query->where('committee_id', Auth::user()->branch);
        })->where('status','active')->get();
        
        $committeefilter = CommitteeYear::when(Auth::user()->branch != 100, function($query) {
            $query->where('committee_id', Auth::user()->branch)->where('status','active');
        })->pluck('id');

        $title = $request->input('title');
        $date = $request->input('date');
        $activities_data = CommitteeActivitie::when($title, function($query,$title) {
            return $query->where('title','like',"%{$title}%");
        })
        ->when($date, function($query,$date){
            return $query->where('activities_date','like',"%{$date}%");
        })
        ->whereIn('committee_year_id',$committeefilter)
        ->latest()->paginate(10);

        $activities_data->appends([
            'title' => $title,
            'date'  => $date,
        ]);

        $committeeYearName = CommitteeYear::when(Auth::user()->account_type != 'superadmin', function($query) {
            $query->where('committee_id', Auth::user()->branch)
                ->where('status', 'active');
        })->first();

        return view('Backend.Pages.CommitteeActivities',compact('activities_data', 'committeeYears','committeeYearName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommitteeActivitiesValidate $request)
    {
       
        if(CommitteeActivitie::create($request->validated())){
            return redirect()->route('committeeActivities.index')->with('success', 'এক্টিভিটি সফলভাবে তৈরি হয়েছে');
        }
        else{
            return redirect()->back()->with('error', 'এক্টিভিটি তৈরি ব্যার্থ হয়েছে');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommitteeActivitie $committeeActivitie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeActivitie $committeeActivitie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommitteeActivitiesEdit $request, CommitteeActivitie $committeeActivity)
    {
        $validData = $request->validated();
        $validData['committee_year_id']= CommitteeYear::where('committee_id',Auth::user()->branch)->where('status','active')->value('id');

        if ($committeeActivity->update($validData)) {
            return redirect()->back()->with('success', 'এক্টিভিটি সফলভাবে আপডেট হয়েছে');
        }

        return redirect()->back()->with('error', 'এক্টিভিটি আপডেট ব্যর্থ হয়েছে');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeActivitie $committeeActivity)
    {
        $committeeActivity->delete();

        return redirect()->route('committeeActivities.index')->with('success','এক্টিভিটি সফলভাবে মুছে ফেলা হয়েছে');
    }
}
