<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;


use App\Models\Notice;
use Illuminate\Http\Request;

class FrontendNoticeController extends Controller
{
    public function notice(Request $request)
    {
        $search = $request->input('title');
        $from   = $request->input('from_date');
        $to     = $request->input('to_date');

        $notices = Notice::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when($from && $to, function ($query) use ($from, $to) {
                return $query->whereBetween('date', [$from, $to]);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('frontend.pages.notice', compact('notices', 'search'));
    }

}
