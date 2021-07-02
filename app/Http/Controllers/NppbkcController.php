<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use App\Models\NppbkcFile;

class NppbkcController extends Controller
{
    //
    public function download($id){
        $file = NppbkcFile::findOrFail($id);
        $pathToFile = storage_path('app/'.$file->filename);
        return response()->download($pathToFile);
    }

    // public function permohonan_lokasi_pdf()
    // {
    // 	$pdf = PDF::loadview('pdf.permohonan_lokasi')->setPaper('a4', 'potrait');
    // 	return $pdf->download('permohonan-lokasi-pdf');
    // }

    // public function permohonan_nppbkc_pdf()
    // {
    // 	$pdf = PDF::loadview('pdf.permohonan_nppbkc')->setPaper('a4', 'potrait');
    // 	return $pdf->download('permohonan-nppbkc-pdf');
    // }

    // public function permohonan_lokasi_pdf()
    // {
    //     // usersPdf is the view that includes the downloading content
    //     $view = \View::make('pdf.permohonan_lokasi');
    //     $html_content = $view->render();
    //     // Set title in the PDF
    //     PDF::SetTitle("NPPBKC");
    //     PDF::AddPage();
    //     PDF::writeHTML($html_content, true, false, true, false, '');
    //     // userlist is the name of the PDF downloading
    //     PDF::Output('permohonan_nppbkc.pdf');    
    // }
}
