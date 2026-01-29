<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function dashboard(){
        return view('Backend.Pages.Dashboard');
    }

    public function notice(){
        return view('Backend.Pages.Notice');
    }

    public function centralCommittee(){
        return view('Backend.Pages.Committee');
    }

    public function branchCommittee(){
        return view('Backend.Pages.Branch-Committee');
    }

    public function branchCommitteeList(){
        return view('Backend.Pages.Branch-Committee-List');
    }

    public function committeeCreate(){
        return view('Backend.Pages.CommitteeCreate');
    }

    public function specialPerson(){
        return view('Backend.Pages.Special-Person');
    }

    public function lifeTimePerson(){
        return view('Backend.Pages.Lifetime-Person');
    }

    public function generalPerson(){
        return view('Backend.Pages.General-Person');
    }

    public function personCreate(){
        return view('Backend.Pages.PersonCreate');
    }

    


    public function activities(){
        return view('Backend.Pages.Activities');
    }

    
    
    public function changePassword(){
        return view('Backend.Pages.Change-Password');
    }

}
