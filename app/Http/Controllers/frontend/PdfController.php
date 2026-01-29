<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PdfController extends Controller
{
    public function download()
    {
        $filePath = public_path('files/Constitution.pdf'); 
        if (!file_exists($filePath)) {
            abort(404, 'PDF file not found!');
        }

        return response()->download($filePath, 'Constitution.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
