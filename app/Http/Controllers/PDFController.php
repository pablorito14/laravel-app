<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
// use PDF;

class PDFController extends Controller
{
  public function generarPdf($id){

    $factura_db = Factura::findOrFail($id);
    
    $pdf = PDF::loadView('pdf.factura',['factura' => $factura_db]);
    // return $pdf->download('testpdf.pdf');
    return $pdf->stream("Factura nro $factura_db->id");

    // return view('pdf.factura',['factura' => $factura_db]);
  }
}
