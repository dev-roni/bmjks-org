<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donation;
use App\Models\DonationEvent;
use App\Models\Person;

class DonetorController extends Controller
{
    public function donetorFrontend()
    {
        $donations = Donation::with(['person', 'event'])
            ->whereHas('person', function ($query) {
                $query->where('donator', 'yes');
            })
            ->orderByDesc('date') // সর্বশেষ ডোনেশন আগে দেখাবে
            ->paginate(10);

        return view('frontend.pages.recent_donation', compact('donations'));
    }

    public function topDonetorFrontend()
    {
        $persons = Person::where('donator', 'yes')
            ->with('donations.event')
            ->withSum('donations', 'donate_amount')
            ->orderByDesc('donations_sum_donate_amount')
            ->paginate(10);

    return view('frontend.pages.donetor_list', compact('persons'));
    }
}
