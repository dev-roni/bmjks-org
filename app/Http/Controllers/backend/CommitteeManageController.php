<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CommitteeName;
use App\Models\CommitteeYear;
use App\Models\CommitteeMember;

class CommitteeManageController extends Controller {

    public function committeeCreate(){
        $committees = CommitteeName::all();
        return view('Backend.Pages.CommitteeCreate', compact('committees'));
    }

    public function committeeActiveListView(){
        $committees = CommitteeYear::withCount('committee_members')->where('status', 'active')
            ->when(Auth::user()->branch != 100, function($query) {
                $query->where('committee_id', Auth::user()->branch);
            })->get();
        $totalActiveMembers = $committees->sum('committee_members_count');
        $totalActiveCommittees = $committees->count();
        

        $deactiveCommittees = CommitteeYear::withCount('committee_members')->where('status', 'deactive')
            ->when(Auth::user()->branch != 100, function($query) {
                $query->where('committee_id', Auth::user()->branch);
            })->get();
        $totalDeactiveMembers = $deactiveCommittees->sum('committee_members_count');
        $totalDeactiveCommittees = $deactiveCommittees->count();

        return view('Backend.Pages.Committee-List', compact('committees', 'totalActiveMembers', 'totalDeactiveMembers', 'totalActiveCommittees', 'totalDeactiveCommittees'));
    }

    public function committeeDeactiveListView(){
        $committees = CommitteeYear::withCount('committee_members')->where('status', 'deactive')
            ->when(Auth::user()->branch != 100, function($query) {
                $query->where('committee_id', Auth::user()->branch);
            })->get();
        $totalDeactiveMembers = $committees->sum('committee_members_count');
        $totalDeactiveCommittees = $committees->count();

        $activeCommittees = CommitteeYear::withCount('committee_members')->where('status', 'active')
            ->when(Auth::user()->branch != 100, function($query) {
                $query->where('committee_id', Auth::user()->branch);
            })->get();
        $totalActiveMembers = $activeCommittees->sum('committee_members_count');
        $totalActiveCommittees = $activeCommittees->count();

        return view('Backend.Pages.Committee-List', compact('committees', 'totalDeactiveMembers', 'totalActiveMembers', 'totalActiveCommittees', 'totalDeactiveCommittees'));
    }
}
