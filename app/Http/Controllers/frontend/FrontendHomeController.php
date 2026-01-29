<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Service;
use App\Models\Notice;
use App\Models\President;
use App\Models\CommitteeMember;
use App\Models\CommitteeName;
use App\Models\CommitteeYear;

class FrontendHomeController extends Controller{

    public function home_view(){
        $response = Http::get('http://localhost/wp/wp-json/wp/v2/posts?per_page=4&_fields=id,date,title,excerpt,link');
        $posts = $response->json();
        $services = Service::all();
        $notices = Notice::latest()->take(3)->get();
        $president = President::latest()->first();
        return view('frontend.pages.home', compact('services', 'posts','notices','president'));
    }

    public function comittee_view($slug){

        $committeeData = CommitteeName::where('committee_slug', $slug)->first();

        if (!$committeeData) {
            return view('frontend.pages.data-not-found');
        }

        $committeeYearData = CommitteeYear::where('committee_id', $committeeData->id)
            ->where('status', 'active')
            ->first();

        if (!$committeeYearData) {
            return view('frontend.pages.data-not-found');
        }

        $committeeMembers = CommitteeMember::where('CommitteeYear_id', $committeeYearData->id)
            ->orderBy('role')
            ->get();

        return view('frontend.pages.full_commitee', compact('committeeData', 'committeeMembers'));
    }



}
