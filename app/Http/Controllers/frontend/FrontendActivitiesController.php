<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommitteeActivitie;
use App\Models\CommitteeMember;
use App\Models\CommitteeYear;

class FrontendActivitiesController extends Controller {
    public function committeeActivities() {
        $committeeYears = CommitteeYear::with([
        'committee_members' => function($members) {
            $members->select('id', 'CommitteeYear_id', 'name', 'role', 'photo')
                    ->whereIn('role', ['1', '4']);
        }, 'committeeActivities'])
        ->whereHas('committeeActivities')
        ->orderByRaw("CASE WHEN status = 'active' THEN 0 ELSE 1 END ASC")
        ->latest('id')
        ->paginate(10);

        return view('frontend.pages.comitee_activities', compact('committeeYears'));
    }

    public function activitieSearch(Request $request) {
        $request->validate([
            'search' => 'required|string|max:100',
        ], [
            'search.required' => 'অনুগ্রহ করে সার্চ ফিল্ডটি পূরণ করুন।',
            'search.string'   => 'সার্চ ফিল্ডে শুধুমাত্র লেখা ব্যবহার করতে হবে।',
            'search.max'      => 'সার্চ ফিল্ড সর্বোচ্চ 100 অক্ষরের হতে পারে।',
        ]);

        $activities = CommitteeActivitie::with(['committeeYear.committee_members' => function($members){
            $members->select('id', 'CommitteeYear_id', 'name', 'role', 'photo')
                    ->whereIn('role', ['1', '4']);
        }])->where('title', 'like', "%{$request->search}%")->paginate(5);

        $activities->appends(['search' => $request->search]);

        $committeeYears = $activities;

        return view('frontend.pages.comitee_activities', compact('committeeYears'));
    }

    public function activitieFilter(Request $request) {
        $request->validate([
            'filter' => 'required|date',
        ], [
            'filter.required' => 'ফিল্টার ফিল্ডটি অবশ্যই দিতে হবে।',
            'filter.date' => 'অনুগ্রহ করে সঠিক তারিখ প্রদান করুন।',
        ]);

        $activities = CommitteeActivitie::with(['committeeYear.committee_members' => function($members){
            $members->select('id', 'CommitteeYear_id', 'name', 'role', 'photo')
                    ->whereIn('role', ['1', '4']);
        }])->where('activities_date', $request->filter)->paginate(5);

        $activities->appends(['filter' => $request->filter]);

        $committeeYears = $activities;

        return view('frontend.pages.comitee_activities', compact('committeeYears'));
    }
}