<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\PersonType;
use App\Models\PersonTag;

class FrontendDatabaseController extends Controller
{
    public function bmjks_database_info(){
       $tags = PersonType::where('status','active')->get();
        foreach($tags as $tag){
            $tag->persons_count = PersonTag::where('persontype_id', $tag->id)->count();
        }
        return view('frontend.pages.database_info', compact('tags'));
    }

    public function personTypeDataShow($personType){

       // Step 1: PersonType মডেল থেকে তথ্য নাও (রিলেশনসহ এবং person এর personType সহ)
        $personTypeData = PersonType::with(['people.personType'])
            ->findOrFail($personType);

        // Step 2: নাম এবং সম্পর্কিত persons গুলো পাও
        $personTypeName = $personTypeData->person_type_name;

        // Step 3: PersonType এর রিলেশন থেকে persons paginate করে আনো
        $persons = $personTypeData->people()->with('personType')->paginate(10);

        $tags = PersonType::get();
        return view('frontend.Pages.Person-list-view', compact('persons', 'personTypeName','tags'));
    }
}
