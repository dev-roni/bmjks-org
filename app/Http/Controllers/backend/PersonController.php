<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\PersonType;
use App\Models\PersonTag;
use App\Models\CommitteeName;
use App\Http\Requests\PersonValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($personType)
    {
       // Step 1: PersonType মডেল থেকে তথ্য নাও (রিলেশনসহ এবং person এর personType সহ)
        $personTypeData = PersonType::with(['people.personType'])
            ->findOrFail($personType);

        // Step 2: নাম এবং সম্পর্কিত persons গুলো পাও
        $personTypeName = $personTypeData->person_type_name;

        // Step 3: PersonType এর রিলেশন থেকে persons paginate করে আনো
        $persons = $personTypeData->people()
                ->where('member_aproved', 'yes')
                 ->when(!in_array(Auth::user()->account_type, ['superadmin', 'cashier']), function ($query) {
                        $query->where('gm_id', Auth::user()->branch);
                    })
                ->with('personType')->latest()
                ->paginate(10);

        $tags = PersonType::get();
        return view('Backend.Pages.Person-List', compact('persons', 'personTypeName','tags'));
    }

    //ব্যাক্তি সার্চ
    public function personSearch(){
        $tags = PersonType::get();
        return view('Backend.Pages.Person-Search',compact('tags'));
    }
    //সার্চ রিজাল্ট
    public function searchResult(Request $request){
        
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
        $tags = PersonType::get();

        return view('Backend.Pages.Person-Search', compact('persons','tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $committeeNames = CommitteeName::get();
        $tags = PersonType::get();
        return view('Backend.Pages.PersonCreate',compact('tags', 'committeeNames'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonValidation $request) {
        DB::beginTransaction();

            $validdata = $request->validated();
            $selectedTags = $request->input('person_tag', []);
            if (in_array(2, $selectedTags) && empty($validdata['gm_id'])) {
                return redirect()->back()->with('error', 'সাধারণ সদস্যের কমিটি নির্বাচন করুন');
            }

        try {
            $validdata['member_aproved'] = 'yes';

            if ($request->hasFile('photo')) {
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/person'), $imageName);
                $validdata['photo'] = $imageName;
            } else {
                $validdata['photo'] = null;
            }

            $person = Person::create($validdata);
            foreach ($selectedTags as $tagId) {
                PersonTag::create([
                    'person_id'     => $person->id,
                    'persontype_id' => $tagId
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'সফলভাবে সংরক্ষণ করা হয়েছে!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Person Store Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'কিছু একটা সমস্যা হয়েছে! আবার চেষ্টা করুন।');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(PersonValidation $request, Person $person){
 
        if ((Auth::user()->account_type != 'superadmin' && Auth::user()->account_type != 'cashier') && $person->personType->contains('id', 1)) {
            return redirect()->back()->with('error', 'আজীবন সদস্যের তথ্য আপডেট করা যাবে না');
        }

        DB::beginTransaction();

        try {
            // ✅ ভ্যালিড ডেটা নেওয়া
            $validdata = $request->validated();

            $selectedTags = $request->input('person_tag', []);
            $lifetime_tag_count = PersonTag::where('person_id', $person->id)->where('persontype_id','1')->count();
            if(Empty($selectedTags) and $lifetime_tag_count==0){
                return redirect()->back()->with('error','যেকোন একটি ক্যাটাগরি সিলেক্ট করুন');
            }

            // ✅ পুরনো ইমেজ ডিলিট + নতুন আপলোড
            if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
                // পুরনো ছবি মুছে ফেলা (যদি থাকে)
                if ($person->photo && File::exists(public_path('uploads/person/' . $person->photo))) {
                    File::delete(public_path('uploads/person/' . $person->photo));
                }

                // নতুন ছবি আপলোড
                $image = $request->file('photo');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/person'), $imageName);
                $validdata['photo'] = $imageName;
            }

            // ✅ Person আপডেট করা
            $person->update($validdata);

            // পুরনো ট্যাগ ডিলিট করা
            PersonTag::where('person_id', $person->id)->where('persontype_id', '!=', 1)->delete();

            // নতুন ট্যাগ insert করা
            
            
            foreach ($selectedTags as $tagId) {
                PersonTag::create([
                    'person_id'     => $person->id,
                    'persontype_id' => $tagId
                ]);
            }


            DB::commit();
            return redirect()->back()->with('success', 'সফলভাবে আপডেট করা হয়েছে!');
        } catch (\Exception $e) {
            DB::rollBack();
            //return $e->getMessage();
            \Log::error('Person Update Error: ' . $e->getMessage());
            
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        // যদি personType আছে এবং id 1 থাকে, delete না করা
        if ($person->member_aproved === 'yes' && $person->personType->contains('id', 1)) {
            return redirect()->back()->with('error', 'এই ধরনের সদস্য ডিলিট করা যাবে না।');
        }

        // যদি ছবি থাকে, আগে ডিলিট করা
        if ($person->photo && file_exists(public_path('uploads/person/' . $person->photo))) {
            unlink(public_path('uploads/person/' . $person->photo));
        }

        $person->delete();

        return redirect()->back()->with('success', 'সদস্য সফলভাবে ডিলিট হয়েছে');
    }


    public function tag(){
        $tags = PersonType::get();
        foreach($tags as $tag){
            $tag->persons_count = PersonTag::where('persontype_id', $tag->id)->count();
        }
        return view('Backend.Pages.Person-Tag-Create',compact('tags'));
    }

    public function tagcreate(Request $request){
            // ভ্যালিডেশন
        $request->validate([
            'tag_create' => 'required|string|max:255|unique:person_types,person_type_name',
        ], [
            'tag_create.required' => 'ক্যাটাগরির নাম অবশ্যই দিতে হবে।',
            'tag_create.string'   => 'ক্যাটাগরির নাম অবশ্যই টেক্সট হতে হবে।',
            'tag_create.max'      => 'ক্যাটাগরির নাম সর্বোচ্চ ২৫৫ অক্ষরের হতে পারবে।',
            'tag_create.unique'   => 'এই ক্যাটাগরি আগেই তৈরি করা হয়েছে।',
        ]);

        // ডাটা সংরক্ষণ
        PersonType::create([
            'person_type_name' => $request->tag_create,
        ]);

        // সফল হলে রিডাইরেক্ট + মেসেজ
        return redirect()->back()->with('success', 'নতুন ক্যাটাগরি সফলভাবে যোগ করা হয়েছে!');
    }
    public function tagdelete($id){
        $person_tag = PersonTag::where('persontype_id',$id)->count();
        if($person_tag == 0){
            $tag = PersonType::findOrFail($id); // ID অনুযায়ী ট্যাগ খুঁজে বের করা
            $tag->delete();
            return redirect()->back()->with('success', 'ক্যাটাগরি সফলভাবে ডিলিট করা হয়েছে!');
        }
        else{
            return redirect()->back()->with('error', ' এই ক্যাটাগরির মানুষ ইতোমধ্যে রয়েছে');
        }
        
    }
    public function tagstatus($id){
        $tagStatus = PersonType::find($id);
        
        if($tagStatus->status=='active'){
            $tagStatus->status='deactive';
            $mgs = 'ক্যাটাগরিটি নিস্ক্রিয় করা হয়েছে';
        }
        else{
            $tagStatus->status='active';
            $mgs = 'ক্যাটাগরিটি সক্রিয় করা হয়েছে';
        }
        $tagStatus->update();
        return redirect()->back()->with('success',$mgs);
    }

    public function lifetimeMemberPaddingList(){
        $personTypeData = PersonType::with(['people.personType'])
            ->findOrFail(1);
        $personTypeName = $personTypeData->person_type_name;
        $persons = $personTypeData->people()->with('personType')->where('member_aproved', 'no')->paginate(10);
        $tags = PersonType::get();
        return view('Backend.Pages.Person-List', compact('persons', 'personTypeName','tags'));
    }

    public function generalMemberPaddingList(){
        $personTypeData = PersonType::with(['people.personType'])
            ->findOrFail(2);
        $personTypeName = $personTypeData->person_type_name;
        $persons = $personTypeData->people()->with('personType')->where('member_aproved', 'no')->paginate(10);
        if(Auth::user()->account_type=='superadmin'){
            $persons = $personTypeData->people()->with('personType')->where('member_aproved', 'no')->paginate(10);
        }
        if(Auth::user()->account_type=='admin'){
            $persons = $personTypeData->people()->with('personType')->where('gm_id', Auth::user()->branch)->where('member_aproved', 'no')->paginate(10);
        }
        $tags = PersonType::get();
        return view('Backend.Pages.Person-List', compact('persons', 'personTypeName','tags'));
    }

    public function lifetimeMemberApprove(Request $request, $id){
        if(Auth::user()->account_type == 'cashier' || Auth::user()->account_type == 'superadmin'){
            $people = Person::find($id);
            $people->member_aproved = 'yes';
            $people->save();
            return redirect()->back()->with('success', 'আজীবন সদস্য সফলভাবে অনুমোদন করা হয়েছে।');
        }
        else{
            return redirect()->back()->with('error', 'আজীবন সদস্য অনুমোদন করতে ব্যর্থ হয়েছে।');
        }
    }

    public function generalMemberApprove(Request $request, $id){
        if(Auth::user()->account_type == 'admin' || Auth::user()->account_type == 'superadmin'){
            $people = Person::find($id);
            $people->member_aproved = 'yes';
            $people->save();
            return redirect()->back()->with('success', 'সাধারন সদস্য সফলভাবে অনুমোদন করা হয়েছে।');
        }
        else{
            return redirect()->back()->with('error', 'সাধারন সদস্য অনুমোদন করতে ব্যর্থ হয়েছে।');
        }
    }
    
}
