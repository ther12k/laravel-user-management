<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF,QrCode,Storage;

use Carbon\Carbon;

use App\Models\NppbkcFile;
use App\Models\Nppbkc;

class NppbkcController extends Controller
{
    //
    public function download($id){
        $file = NppbkcFile::findOrFail($id);
        $pathToFile = storage_path('app/'.$file->filename);
        return response()->download($pathToFile,'surat_permohonan_nppbkc_'.$id.'_'.date('Ymd').'.pdf');
    }

    public function generate_permohonan_cek_lokasi($id){
        $nppbkc = Nppbkc::find($id);
        $pdfHTML = view('pdf.permohonan_lokasi')->render();
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $dataPdf['regency'] = $nppbkc->regency->name;
        foreach($dataPdf as $key=>$val){
            if($key=='no_permohonan') continue;
            $formats[]='['.strtoupper($key).']';
            if($key=='nama_usaha')
                $val=strtoupper($val);
            if(strpos($key,'masa_berlaku')!==false||
                strpos($key,'tanggal')!==false){
                    $val=Carbon::parse($val)->isoFormat('D MMMM Y');
                }
            $val = '<strong>'.$val.'</strong>';
            $replaces[]=$val;
        }
        $formats[]='[NO_PERMOHONAN]';
        $replaces[]='<strong>'.$nppbkc->no_permohonan_lokasi.'</strong>';
        
        $formats[]='[TANGGAL_PENGAJUAN]';
        $replaces[]='<strong>'.$nppbkc->created_at->isoFormat('D MMMM Y').'</strong>';

        //replace all
        $pdfHTML = str_replace($formats,$replaces,$pdfHTML);

        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(60)
            ->generate(url('/nppbkc/generate_permohonan_lokasi/'.$nppbkc->id))
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);
        
        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_cek_lokasi.pdf';
        // $exists = Storage::disk('local')->exists($pdf_filename);
        // if($exists){
        //     Storage::delete($pdf_filename);
        // }
        Storage::put($pdf_filename, $pdf->output());
        $nppbkc->files()->save(
                            new NppbkcFile([
                                'name'=>'surat_permohonan_lokasi',
                                'title'=>'Surat Permohonan Pengecekan Lokasi',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'is_annotation'=>2
                            ])
                        );
        return $pdf->download('surat_permohonan_cek_lokasi_'.$id.'_'.date('Ymd').'.pdf');            
    }

    public function generate_nppbkc($id){
        $nppbkc = Nppbkc::find($id);
        $pdfHTML = view('pdf.permohonan_nppbkc')->render();
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $dataPdf['province'] = $nppbkc->province->name;
        $dataPdf['regency'] = $nppbkc->regency->name;
        $dataPdf['district'] = $nppbkc->district->name;
        $dataPdf['village'] = $nppbkc->village->name;
        foreach($dataPdf as $key=>$val){
            if(isset($val)){
                
            }
            $formats[]='['.strtoupper($key).']';
            if($key=='nama_usaha')
                $val=strtoupper($val);
            if(strpos($key,'masa_berlaku')!==false||
                strpos($key,'tanggal')!==false){
                    $val=Carbon::parse($val)->isoFormat('D MMMM Y');
                }
            $val = '<strong>'.$val.'</strong>';
            $replaces[]=$val;
        }
        $formats[]='[MAP_URL]';
        $replaces[]='<strong>'.$nppbkc->lokasi_latitude.', '.$nppbkc->lokasi_longitude.'</strong>';

        $formats[]='[NO_PERMOHONAN]';
        $replaces[]='<strong>'.$nppbkc->no_permohonan.'</strong>';

        $annotation = $nppbkc->annotations()->OfStatus(3)->first();
        $annotationDate = $annotation->created_at->isoFormat('D MMMM Y');
        $formats[]='[TANGGAL_PERMOHONAN_NPPBKC]';
        $replaces[]='<strong>'.$annotationDate.'</strong>';
        $formats[]='[TANGGAL_BA_CEK_LOKASI]';
        $replaces[]='<strong>'.$annotationDate.'</strong>';

        //replace all
        $pdfHTML = str_replace($formats,$replaces,$pdfHTML);

        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(100)
            ->generate(url('/nppbkc/download/'.$nppbkc->id))
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);
        
        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_nppbkc.pdf';
        // $exists = Storage::disk('local')->exists($pdf_filename);
        // if($exists){
        //     Storage::delete($pdf_filename);
        // }
        Storage::put($pdf_filename, $pdf->output());
        $nppbkc->files()->save(
                            new NppbkcFile([
                                'name'=>'surat_permohonan_nppbkc',
                                'title'=>'Surat Permohonan NPPBKC',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'is_annotation'=>2
                            ])
                        );
        return $pdf->download('surat_permohonan_nppbkc_'.$id.'_'.date('Ymd').'.pdf');   
        //return View('pdf.permohonan_nppbkc');         
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
