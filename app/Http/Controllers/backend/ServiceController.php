<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ServicesDataValidate;
use App\Models\Service;

class ServiceController extends Controller {
    public function services(){
        $services = Service::all();
        return view('Backend.Pages.Services', compact('services'));
    }

    public function serviceStore(ServicesDataValidate $request){
        $validatedData = $request->validated();

        $service = Service::create([
            "icon"        => $validatedData['icon'],
            "title"       => $validatedData['title'],
            "description" => $validatedData['description'],
        ]);

        if($service){
            return redirect()->back()->with("success", "সেবা সফলভাবে সংরক্ষিত হয়েছে।");
        }

        return redirect()->back()->with("error", "দুঃখিত, সেবা সংরক্ষণ করতে সমস্যা হয়েছে। দয়া করে আবার চেষ্টা করুন।");
    }

    public function serviceUpdate(ServicesDataValidate $request, $id){
        $validatedData = $request->validated();

        $services = Service::find($id);
        if(!$services){
            return redirect()->back()->with('error', 'সেবা তথ্য পাওয়া যায়নি! অনুগ্রহ করে পুনরায় চেষ্টা করুন।');
        }

        $services->update([
            "icon"        => $validatedData['icon'],
            "title"       => $validatedData['title'],
            "description" => $validatedData['description'],
        ]);

        return redirect()->back()->with("success", "সেবা সফলভাবে হালনাগাদ হয়েছে।");
    }

    public function serviceDestroy(Request $request, $id){
        $service = Service::find($id);

        if(!$service){
            return redirect()->back()->with("error", "সেবা খুঁজে পাওয়া যায়নি।");
        }

        $service->delete();

        return redirect()->back()->with("success", "সেবা সফলভাবে মুছে ফেলা হয়েছে।");
    }
}
