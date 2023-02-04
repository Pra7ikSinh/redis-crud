<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
// use Barryvdh\DomPDF\Facade\Pdf;
// use Barryvdh\DomPDF\PDF;
use PDF;


class PDFController extends Controller
{
    public function PDFgenerate(request $request)
   {

    //    $employee = employee::findOrFail($id);
    //    $data = compact('employee');
    //    $PDF = PDF::loadView('PDF_Format', $data);
       $PDF = PDF::loadView('PDF');
       $PDF->set_option('isHtml5ParserEnabled', true);
       $PDF->set_option('isRemoteEnabled', true);
       // $path = public_path('/pdf');
       // return $PDF->save()
       // $PDF->save($path ."/".$employee->first_name.".pdf");
       return $PDF->download('invoice.pdf');
       // return view('PDF_Format')->with($data);

   }

}
