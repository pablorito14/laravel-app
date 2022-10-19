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
    

    // $factura = [
    //   'id' => $factura_db->id,
    //   'cliente' => $factura_db->cliente,
    //   'total' => $factura_db->total,
    //   'comprobante' => $factura_db->comprobante,
    //   'estado' => $factura_db->estado,
    //   'fecha' => \Carbon\Carbon::createFromFormat('Y-m-d', $factura_db->fecha)->format('d/m/Y'),
    //   'detalles' => []
    // ];

    
    // foreach ($factura_db->detalles as $detalle ) {
    //   $det = [
    //     'servicio' => $detalle->servicio->descripcion,
    //     'importe' => $detalle->importe,
    //   ];
    //   array_push($factura['detalles'],$det);
    // }
    $pdf = PDF::loadView('pdf.factura',['factura' => $factura_db]);
    // return $pdf->download('testpdf.pdf');
    return $pdf->stream("Factura nro $factura_db->id");


    

    return view('pdf.factura',['factura' => $factura_db]);
  }
}
