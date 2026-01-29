<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ChadaCollection;
use App\Models\ChadaSetting;
use App\Models\CommitteeName;
use Illuminate\Http\Request;

class MonthlyContributionController extends Controller {

    public function monthlyContribution(){
        $contributions = ChadaCollection::with('committee')
                       ->selectRaw('committee_id,
                            SUM(CASE WHEN payment_status = "paid" THEN amount ELSE 0 END) as total_paid_amount,
                            SUM(CASE WHEN payment_status IN ("not_paid","pending") THEN amount ELSE 0 END) as total_not_paid_amount,
                            COUNT(CASE WHEN payment_status = "paid" THEN 1 END) as total_paid_count,
                            COUNT(CASE WHEN payment_status IN ("not_paid","pending") THEN 1 END) as total_not_paid_count')
                       ->groupBy('committee_id')
                       ->when(!in_array(Auth::user()->account_type, ['superadmin', 'cashier']), 
                            function ($query) {
                            $query->where('committee_id', Auth::user()->branch);
                            })
                       ->get();

        return view('Backend.Pages.Monthly-Contribution', compact('contributions'));
    }


    public function monthlyContributionList($committeeId){
        $contributionList = ChadaCollection::with('chadaName', 'committee')
                          ->where('committee_id', $committeeId)
                          ->paginate(12);
        $committeeName = CommitteeName::where('id',$committeeId)->value('committee_name');

        return view('Backend.Pages.Monthly-Contribution-List', compact('contributionList','committeeName'));
    }

    public function contributionApprove($approveId){
        $updated = ChadaCollection::where('id', $approveId)->update([
            'payment_status' => 'paid'
        ]);

        if ($updated) {
            return redirect()->back()->with('success', 'চাঁদাটি সফলভাবে অনুমোদন করা হয়েছে!');
        } else {
            return redirect()->back()->with('error', 'চাঁদাটি অনুমোদন করা যায়নি!');
        }
    }

    public function contributionReject($rejectId){
        $updated = ChadaCollection::where('id', $rejectId)->update([
            'payment_status' => 'not_paid'
        ]);

        if ($updated) {
            return redirect()->back()->with('success', 'চাঁদাটি সফলভাবে বাতিল করা হয়েছে!');
        } else {
            return redirect()->back()->with('error', 'চাঁদাটি বাতিল করা যায়নি!');
        }
    }

    public function contributionRequest($requestId){
        $updated = ChadaCollection::where('id', $requestId)->update([
            'payment_status' => 'pending'
        ]);

        if ($updated) {
            return redirect()->back()->with('success', 'আপনার চাঁদার অনুরোধটি সফলভাবে পাঠানো হয়েছে!');
        } else {
            return redirect()->back()->with('error', 'আপনার চাঁদার অনুরোধটি পাঠানো যায়নি!');
        }
    }

    public function chadaSettingsView(){
        $chadaSetting = ChadaSetting::get();
        return view('Backend.Pages.Chada-settings',compact('chadaSetting'));
    }
    
    public function chadaSettingsStore(Request $request)
    {
        $validdata = $request->validate([
            'central_chada_amount' => 'required|numeric|min:0|max:100000',
            'branch_chada_amount' => 'required|numeric|min:0|max:100000',
        ], [
            'central_chada_amount.required' => 'কেন্দ্রীয় চাঁদার পরিমাণ দিতে হবে।',
            'central_chada_amount.numeric' => 'কেন্দ্রীয় চাঁদার পরিমাণ অবশ্যই সংখ্যা হতে হবে।',
            'central_chada_amount.min' => 'কেন্দ্রীয় চাঁদার পরিমাণ শূন্যের কম হতে পারবে না।',
            'central_chada_amount.max' => 'কেন্দ্রীয় চাঁদার পরিমাণ ১০০০০০ এর বেশি হতে পারবে না।',

            'branch_chada_amount.required' => 'শাখা চাঁদার পরিমাণ দিতে হবে।',
            'branch_chada_amount.numeric' => 'শাখা চাঁদার পরিমাণ অবশ্যই সংখ্যা হতে হবে।',
            'branch_chada_amount.min' => 'শাখা চাঁদার পরিমাণ শূন্যের কম হতে পারবে না।',
            'branch_chada_amount.max' => 'শাখা চাঁদার পরিমাণ ১০০০০০ এর বেশি হতে পারবে না।',
        ]);

        // আগের ডাটা আপডেট করো
        $setting = ChadaSetting::first(); // টেবিলে একটাই রেকর্ড আছে ধরে নিচ্ছি

        if ($setting) {
            $setting->update($validdata);
        } else {
            ChadaSetting::create($validdata);
        }

        return redirect()->back()->with('success', 'চাঁদা সেটিংস সফলভাবে হালনাগাদ হয়েছে।');
    }


}
