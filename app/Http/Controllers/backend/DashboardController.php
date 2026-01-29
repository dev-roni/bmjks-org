<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\PersonType;
use App\Models\PersonTag;
use App\Models\CommitteeYear;
use App\Models\CommitteeMember;
use App\Models\ViewCount;
use App\Events\ChadaManegement;


class DashboardController extends Controller {

    public function __construct()
    {
        //fire event
        event(new ChadaManegement());
    }

    public function Dashboard(){
        $notices = Notice::orderBy('id', 'desc')->take(5)->get();
        $title = 'Dashboard';

        $tags = PersonType::where('status', 'active')
            ->with(['people' => function ($query) {$query->where('member_aproved', 'yes')
                ->when(!in_array(Auth::user()->branch, ['99', '100']), 
                function ($query) {$query->where('gm_id', Auth::user()->branch);});
            }])
            ->get();


        $committees = CommitteeYear::where('status', 'active')->when(!in_array(Auth::user()->branch, ['1', '100']), 
            function ($query) {
            $query->where('committee_id', Auth::user()->branch);
            })->withCount('committee_members')->get();

        $total_active_member = $committees->sum('committee_members_count');
        
        $view_count = ViewCount::value('count');

        return view('Backend.Pages.Dashboard', compact('notices','title', 'tags', 'committees','total_active_member','view_count'));
    }
}
