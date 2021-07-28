<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF,QrCode,Storage,Hash;

use Carbon\Carbon;

use App\Models\NppbkcFile;
use App\Models\Nppbkc;

class NppbkcController extends Controller
{
    private $hashKey = "nppbkc-file";
    //
    public function downloadFile($id,$view=false){
        $file = NppbkcFile::OfKey($id)->first();
        // dd($file->filename);
        if($file==null)
            return abort('404');
        if($view){
            return Storage::disk('nppbkc')->download($file->filename, $file->name.'_'.$file->id.'_'.date('Ymd').'.'.$file->ext, [
                'Content-Disposition' => 'inline'
            ]);
            //return response()->download(storage_path('app/'.$file->filename),$file->name.'_'.$file->id.'_'.date('Ymd').'.'.$file->ext, [], 'inline');
        }
        return Storage::disk('nppbkc')->download($file->filename, $file->name.'_'.$file->id.'_'.date('Ymd').'.'.$file->ext);
        //return response()->download(storage_path('app/'.$file->filename),$file->name.'_'.$file->id.'_'.date('Ymd').'.'.$file->ext);
    }

    public function viewFile($id){
        return $this->downloadFile($id,true);
    }

    public function generate_ttd_cek_lokasi($id){
        $nppbkc = Nppbkc::findOrFail($id);
        $pdfHTML = view('pdf.ttd_permohonan_lokasi')->render();

        $no = Nppbkc::whereNotNull('ttd_permohonan_lokasi')->orderByDesc('id')->first();
        if($no!=null){
            $no = (int)(explode('-',explode('/', $no->ttd_permohonan_lokasi)[0])[1]);
        }else{
            $no=0;
        }
        $nppbkc->ttd_permohonan_lokasi = 'TTD-'.str_pad($no+1,6,"0",STR_PAD_LEFT).'/CEKLOK/WBC.15/KPP.MP.04/'.date('Y');
        $nppbkc->save();
        
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $formats[]='[NAMA_PEMILIK]';
        $replaces[]=$nppbkc->nama_pemilik;
        $formats[]='[NO_TTD_PERMOHONAN]';
        $replaces[]='<strong>'.$nppbkc->ttd_permohonan_lokasi.'</strong>';
        $formats[]='[NO_PERMOHONAN]';
        $replaces[]=$nppbkc->no_permohonan_lokasi;
        
        $formats[]='[WAKTU_PENGAJUAN]';
        $replaces[]='<strong>'.$nppbkc->created_at->isoFormat('HH:mm, D MMMM Y').'</strong>';
        $formats[]='[TANGGAL_PENGAJUAN]';
        $replaces[]='<strong>'.$nppbkc->created_at->isoFormat('D MMMM Y').'</strong>';

        //replace all
        $pdfHTML = str_replace($formats,$replaces,$pdfHTML);
        
        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_tdd_permohonan_cek_lokasi.pdf';
        
        $hash = md5($this->hashKey.'-ttd-cek-lokasi'.$nppbkc->id);  
        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(80)
            ->generate(url('/nppbkc/view-file/'.$hash))
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'" style="margin-top:2px;margin-bottom:2px">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);

        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        Storage::disk('nppbkc')->put($pdf_filename, $pdf->output());   


        $file = $nppbkc->files()->save(
                            new NppbkcFile([
                                'key'=>$hash,
                                'name'=>'ttd_permohonan_lokasi',
                                'title'=>'TTD Permohonan Pengecekan Lokasi',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'ext'=>'.pdf',
                                'is_annotation'=>9
                            ])
                        ); 
        return Storage::disk('nppbkc')->download($file->filename, 'ttd_permohonan_cek_lokasi_'.$id.'_'.date('Ymd').'.pdf', [
            'Content-Disposition' => 'inline'
        ]);
    }

    private function generate_cek_lokasi($nppbkc){
        $pdfHTML = view('pdf.permohonan_lokasi')->render();
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $dataPdf['regency'] = $nppbkc->regency->name;
        $createdBy = $nppbkc->createdBy()->first()->profile;
        $dataPdf['nama_user'] = $createdBy->nama;
        $dataPdf['pekerjaan_user'] = $createdBy->pekerjaan;
        $dataPdf['email_user'] = $createdBy->email;
        $dataPdf['alamat_user'] = $createdBy->alamat;
        $dataPdf['telp_user'] = $createdBy->no_telp;
        $dataPdf['email_user'] = $nppbkc->createdBy()->first()->email;
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
        
        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_cek_lokasi.pdf';
        // $exists = Storage::disk('local')->exists($pdf_filename);
        // if($exists){
        //     Storage::delete($pdf_filename);
        // }
        $hash = md5($this->hashKey.'-cek-lokasi'.$nppbkc->id);
        $surat_permohonan_lokasi_url = url('/nppbkc/view-file/'.$hash);
        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(80)
            ->generate($surat_permohonan_lokasi_url)
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'" style="margin-top:2px;margin-bottom:2px">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);
        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        Storage::disk('nppbkc')->put($pdf_filename, $pdf->output());     
        $file = $nppbkc->files()->save(
                            new NppbkcFile([
                                'key'=>$hash,
                                'name'=>'surat_permohonan_lokasi',
                                'title'=>'Surat Permohonan Pengecekan Lokasi',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'ext'=>'.pdf',
                                'is_annotation'=>2
                            ])
                        ); 
        return $hash;
    }
    public function generate_permohonan_cek_lokasi($id){
        $nppbkc = Nppbkc::findOrFail($id);
        $hash = $this->generate_cek_lokasi($nppbkc);  
        return $this->downloadFile($hash,true);   
    }

    public function generate_nppbkc($id){
        $pdfHTML = view('pdf.permohonan_nppbkc')->render();
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $dataPdf['province'] = $nppbkc->province->name;
        $dataPdf['regency'] = $nppbkc->regency->name;
        $dataPdf['district'] = $nppbkc->district->name;
        $dataPdf['village'] = $nppbkc->village->name;

        $createdBy = $nppbkc->createdBy()->first()->profile;
        $dataPdf['nama_user'] = $createdBy->nama;
        $dataPdf['pekerjaan_user'] = $createdBy->pekerjaan;
        $dataPdf['email_user'] = $createdBy->email;
        $dataPdf['alamat_user'] = $createdBy->alamat;
        $dataPdf['telp_user'] = $createdBy->no_telp;
        $dataPdf['email_user'] = $nppbkc->createdBy()->first()->email;
        foreach($dataPdf as $key=>$val){
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
        if($annotation!=null)
        {
            $annotationDate = $annotation->created_at->isoFormat('D MMMM Y');
            $formats[]='[TANGGAL_PERMOHONAN_NPPBKC]';
            $replaces[]='<strong>'.$annotationDate.'</strong>';
            $formats[]='[TANGGAL_BA_CEK_LOKASI]';
            $replaces[]='<strong>'.$annotationDate.'</strong>';
        }
        //replace all
        $pdfHTML = str_replace($formats,$replaces,$pdfHTML);

        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_nppbkc.pdf';
        $hash = md5($this->hashKey.'-permohonan-nppbkc'.$nppbkc->id);
        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(80)
            ->generate(url('/nppbkc/download-file/'.$hash))
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'" style="margin-top:2px;margin-bottom:2px">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);
        $file = $nppbkc->files()->save(
                            new NppbkcFile([
                                'key'=>$hash,
                                'name'=>'surat_permohonan_nppbkc',
                                'title'=>'Surat Permohonan NPPBKC',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'is_annotation'=>2
                            ])
                        );
        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        Storage::disk('nppbkc')->put($pdf_filename, $pdf->output());
       
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
