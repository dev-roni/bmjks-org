<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance;

class FrontendBudgetController extends Controller {

    public function budget(){
        $budgets = Finance::orderBy('date', 'desc')->paginate(10);
        return view('frontend.pages.budget', compact('budgets'));
    }

    public function budgetDownload($fileName){
        $file = public_path('finance/' . $fileName);

        if(file_exists($file)) {
            return response()->download($file);
        }
        else{
            return redirect()->back()
                             ->with('error', 'দুঃখিত! নির্দিষ্ট হিসাবটি খুঁজে পাওয়া যায়নি।');
        }
    }

    public function budgetSearch(Request $request) {
        $request->validate([
            'search' => 'required|string|min:2|max:100',
        ], [
            'search.required' => 'অনুগ্রহ করে সার্চ বক্সে বাজেটের নাম লিখুন।',
            'search.string'   => 'সার্চ ইনপুটটি অবশ্যই টেক্সট হতে হবে।',
            'search.min'      => 'সার্চের জন্য অন্তত ২ অক্ষর লিখতে হবে।',
            'search.max'      => 'সার্চ ইনপুট ১০০ অক্ষরের বেশি হতে পারবে না।',
        ]);

        $budgets = Finance::where('title', 'like', "%{$request->search}%")->orderBy('date', 'desc')->paginate(2);
        $budgets->appends(['search' => $request->search]);

        return view('frontend.pages.budget', compact('budgets'));
    }
}
