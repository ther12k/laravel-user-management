<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class NppbkcController extends Controller
{
    //
    public function permohonan_lokasi_pdf()
    {
    	$pdf = PDF::loadview('pdf.permohonan_lokasi');
    	return $pdf->download('permohonan-lokasi-pdf');
    }
}
