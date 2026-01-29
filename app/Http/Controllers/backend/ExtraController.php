<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\PersonType;
use App\Models\ViewCount;
use Illuminate\Http\Request;

class ExtraController extends Controller
{   
    public function personEditView($id){
        $person = Person::with('personType')->where('id',$id)->first();
        $tags = PersonType::get();

        return view('Backend.Pages.person_edit_view', compact('person','tags'));
    }
}
