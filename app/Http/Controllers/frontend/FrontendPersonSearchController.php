<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\PersonTag;
use App\Models\PersonType;

class FrontendPersonSearchController extends Controller {

    public function bmjksDatabase() {
        $tags = PersonType::get();
        return view('frontend.pages.database',compact('tags'));
    }

    public function bmjksDatabaseSearch(Request $request){
        $searchFields = [
            'name','father_husband_name','mother_name','photo',
            'date_of_birth_from','date_of_birth_to','gender','caste','marital_status',
            'mobile_number','village','post_office','thana','district','profession','blood_group',
        ];

        // কোনো ইনপুটও নেই কি না চেক করা
        $filledAny = collect($searchFields)->contains(fn($f) => $request->filled($f));
        if (!$filledAny && !$request->filled('tag')) {
            return back()->with('error', 'অনুগ্রহ করে অন্তত একটি সার্চ ফিল্ড দিন');
        }

        // যদি tag দেয়া থাকে -> PersonType এর people relation থেকে কুয়েরি করে paginate করব
        if ($request->filled('tag')) {
            $personType = PersonType::find($request->input('tag'));

            if (!$personType) {
                // tag invalid হলে empty paginator রিটার্ন করা ভাল (ভিউ যেভাবে paginate expect করে)
                $persons = Person::whereRaw('0 = 1')->paginate(10)->appends($request->all());
            } else {
                // relation()->use() gives an Eloquent query builder so we can paginate
                $personsQuery = $personType->people()->whereNot('member_aproved', 'no');

                // Apply filters to the people() query
                foreach ($searchFields as $field) {
                    if ($request->filled($field)) {
                        $personsQuery->where($field, 'like', "%" . trim($request->input($field)) . "%");
                    }
                }

                $persons = $personsQuery->paginate(10)->appends($request->all());
            }
        } else {

            $query = Person::query()->whereNot('member_aproved', 'no');
            foreach ($searchFields as $field) {
                if ($request->filled($field)) {
                    $query->where($field, 'like', "%" . trim($request->input($field)) . "%");
                }
            }
            $persons = $query->paginate(10)->appends($request->all());
        }

        $tags = PersonType::all();
        return view('frontend.pages.database', compact('persons','tags'));
    }

}
