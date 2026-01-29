<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceValidate;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FinanceController extends Controller
{
    public function finance(Request $request){
        $date = $request->input('date');
        $title = $request->input('title');
        
        $finances = Finance::when($date, function($query, $date){
            return $query->where('date', 'like', "%{$date}%");})
            ->when($title, function($query, $title){
            return $query->where('title', 'like', "%{$title}%");})
            ->latest('date')->paginate(10);

        $finances->appends([
            'date' => $date,
            'title' => $title,
        ]);

        return view('Backend.Pages.Finance', compact('finances'));
    }

    public function sheetCreate(FinanceValidate $request){
        $validateData = $request->validated();

        $pdfName = null;
        if($request->hasFile('pdf_path')){
            $pdf = $request->file('pdf_path');
            $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('finance'), $pdfName);
        }

        $finance = Finance::create([
            "title"    => $validateData['title'],
            "date"     => $validateData['date'],
            "pdf_path" => $pdfName,
        ]);

        if(!$finance){
            return redirect()->back()
                             ->with("error", "দুঃখিত! হিসাব সংরক্ষণ করতে ব্যর্থ হয়েছে।");
        }
        return redirect()->back()
                         ->with("success", "হিসাব সফলভাবে সংরক্ষণ করা হয়েছে।");
    }

    public function sheetDownload($fileName){
        $file = public_path('finance/' . $fileName);

        if(file_exists($file)) {
            return response()->download($file);
        }
        else{
            return redirect()->back()
                             ->with('error', 'দুঃখিত! নির্দিষ্ট হিসাবটি খুঁজে পাওয়া যায়নি।');
        }
    }

    public function sheetUpdate(FinanceValidate $request, $id){
        $validateData = $request->validated();

        $finance = Finance::find($id);
        if(!$finance){
            return redirect()->back()
                             ->with("error", "দুঃখিত! নির্দিষ্ট হিসাবটি খুঁজে পাওয়া যায়নি।");
        }

        if($request->hasFile('pdf_path')) {
            if ($finance->pdf_path && Storage::disk('public')->exists($finance->pdf_path)) {
                Storage::disk('public')->delete($finance->pdf_path);
            }

            $pdf = $request->file('pdf_path');
            $pdfName = time() . '_' . uniqid() . '.' . $pdf->getClientOriginalExtension();
            $pdf->storeAs('finance', $pdfName, 'public');
        }
        else{
            $pdfName = $finance->pdf_path;
        }

        $finance->update([
            "title"    => $validateData['title'],
            "date"     => $validateData['date'],
            "pdf_path" => $pdfName,
        ]);

        if(!$finance){
            return redirect()->back()
                             ->with("error", "আপডেট করার সময় একটি ত্রুটি ঘটেছে। অনুগ্রহ করে আবার চেষ্টা করুন।");
        }
        return redirect()->back()
                         ->with("success", "হিসাব সফলভাবে আপডেট করা হয়েছে।");
    }

    public function sheetDestroy(Request $request, $id){
        $finance = Finance::find($id);
        if(!$finance){
            return redirect()->back()
                             ->with("error", "দুঃখিত! নির্দিষ্ট হিসাবটি খুঁজে পাওয়া যায়নি।");
        }

        $finance->delete();

        return redirect()->back()
                         ->with("success", "হিসাবটি সফলভাবে মুছে ফেলা হয়েছে।");
    }
}
