<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonType;

class FrontendLifetimeMemberController extends Controller {
    
    public function lifetimeMemberView($personType) {
       // Step 1: PersonType মডেল থেকে তথ্য নাও (রিলেশনসহ এবং person এর personType সহ)
        $personTypeData = PersonType::with(['people.personType'])
            ->findOrFail($personType);

        // Step 2: নাম এবং সম্পর্কিত persons গুলো পাও
        $personTypeName = $personTypeData->person_type_name;

        // Step 3: PersonType এর রিলেশন থেকে persons paginate করে আনো
        $persons = $personTypeData->people()->with('personType')->paginate(10);

        // Step 4: ভিউতে পাঠাও
        return view('frontend.pages.lifetime-member-view', compact('persons', 'personTypeName'));
    }
}
