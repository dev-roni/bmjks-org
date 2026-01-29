<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class FrontendServiceController extends Controller
{
    public function service(){
        $services = Service::get();

        return view('frontend.pages.service',compact('services'));
    }
}
