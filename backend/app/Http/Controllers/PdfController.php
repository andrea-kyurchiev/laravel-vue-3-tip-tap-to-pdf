<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use PDF;

class PdfController extends Controller
{

    public function savePdf(Request $request)
    {
        $fileTitle = $string = str_replace(' ', '-', $request->title);
        $fileTitle = preg_replace('/[^A-Za-z0-9\-]/', '', $fileTitle);

        $pdf = PDF::loadView('pdf-view', ['request' => $request])->setPaper('a4', 'landscape')->save($fileTitle . '.pdf');

        return $fileTitle;
    }

    public function getPdf($name)
    {
        return response()->file(public_path()  . '/' .  $name . '.pdf');
    }
}
