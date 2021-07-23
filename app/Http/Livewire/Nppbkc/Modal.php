<?php

namespace App\Http\Livewire\Nppbkc;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use Livewire\WithFileUploads;
use App\Models\Nppbkc;
use App\Models\NppbkcFile;
use App\Models\NppbkcAnnotation;

use App\Notifications\NppbkcUpdatedNotification;
use PDF,Storage,QrCode;
use Carbon\Carbon;

class Modal extends ModalComponent
{
    use WithFileUploads;
    public $nppbkc_id,$status_nppbkc,$catatan_petugas,$file_surat_tugas,$file_ba_periksa,$file_ba_wawancara;
    //tambahan 6 juli 2021
    public $no_ba_cek_lokasi,$tanggal_ba_cek_lokasi;
    public $petugas_files=
    [
        'file_surat_tugas'=>'Surat tugas periksa lokasi',
        'file_ba_periksa'=>'Berita acara periksa lokasi',
        'file_ba_wawancara'=>'Berita acara wawancara'
    ];

    protected $rules = [
            'catatan_petugas' => 'required',
            'file_surat_tugas' => 'required',
            'file_ba_periksa' => 'required',
            'file_ba_wawancara' => 'required',
            'no_ba_cek_lokasi'=>'required',
            'tanggal_ba_cek_lokasi'=>'required'
    ];

    protected $messages = [
        'catatan_petugas.required' => 'Catatan harus diisi.',
        'no_ba_cek_lokasi.required'=>'No BA harus diisi.',
        'tanggal_ba_cek_lokasi.required'=>'Tanggal BA harus diisi.',
        'file_surat_tugas.required'=>'File surat tugas harus diupload',
        'file_ba_periksa.required'=>'File BA periksa harus diupload',
        'file_ba_wawancara.required'=>'File BA wawancara harus diupload',
    ];

    public function mount($id)
    {
        $nppbkc = Nppbkc::findOrFail($id);
        $this->nppbkc_id = $nppbkc->id;
        $this->status_nppbkc = $nppbkc->status_nppbkc;
    }

    public static function modalMaxWidth(): string
    {
        // 'sm'
        // 'md'
        // 'lg'
        // 'xl'
        // '2xl'
        // '3xl'
        // '4xl'
        // '5xl'
        // '6xl'
        // '7xl'
        return '4xl lg:6xl';
    }

    public function render()
    {
        return view('livewire.nppbkc-modal');
    }

    public function setuju_cek()
    {
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        $nppbkc->status_nppbkc=2;
        $nppbkc->catatan_petugas=$this->catatan_petugas;
        $nppbkc->save();
        $url = route('nppbkc.view',[$nppbkc->id]);
        
        $notif = [
            'greeting' => 'Hi '.$nppbkc->createdBy->name,
            'message' =>'Permohonan cek lokasi dengan no '.$nppbkc->no_permohonan_lokasi.', telah disetujui, selanjutnya petugas akan mengecek lokasi, anda bisa memonitor status permohonan melalui link dibawah',
            'text' => 'Permohonan Cek lokasi no '.$nppbkc->no_permohonan_lokasi.' telah disetujui',
            'content' =>'*Permohonan cek lokasi no '.$nppbkc->no_permohonan.", telah disetujui oleh ".\Auth::user()->name.'*',
            'url_title'=>'Cek Permohonan',
            'url' =>$url
        ];

        try{
            $nppbkc->notify(new NppbkcUpdatedNotification($notif));
        }catch (\Exception $e) {
            \Sentry\captureException($e);
        }

        session(['message' => 'Permohonan cek lokasi telah disetujui, silahkan melanjutkan cek lokasi.']);
        // $this->emit('nppbkcStatusUpdated',$nppbkc);
        // $this->closeModal();
        $this->closeModalWithEvents([
            Message::getName() => ['nppbkcFlashMessage', [false]]
            ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
        ]);
    }

    public function tolak_cek()
    {
        $this->validateOnly('catatan_petugas');
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        $nppbkc->status_nppbkc=0;
        $nppbkc->catatan_petugas=$this->catatan_petugas;
        $nppbkc->save();

        $data = [
            'status_nppbkc'=>$nppbkc->status_nppbkc,
            'catatan_petugas'=>$nppbkc->catatan_petugas
        ];
        $url = route('nppbkc.view',[$nppbkc->id]);
        $nppbkc->annotations()->save(new NppbkcAnnotation($data));
    

        $notif = [
            'error'=>'',
            'greeting' => 'Hi '.$nppbkc->createdBy->name,
            'message' =>'Permohonan cek lokasi anda dengan no '.$nppbkc->no_permohonan_lokasi.', telah ditolak, selanjutnya anda dapat melakukan revisi untuk pengajuan ulang dengan mengklik link dibawah ini',
            'text' => 'Permohonan Cek lokasi no '.$nppbkc->no_permohonan_lokasi.' telah ditolak',
            'content' =>'*Permohonan cek lokasi no '.$nppbkc->no_permohonan.", telah ditolak oleh ".\Auth::user()->name.'*',
            'url_title'=>'Cek Permohonan',
            'url' =>$url
        ];

        try{
            $nppbkc->notify(new NppbkcUpdatedNotification($notif));
        }catch (\Exception $e) {
            \Sentry\captureException($e);
        }

        session(['message' => 'Permohonan cek lokasi telah ditolak']);
        // $this->emit('nppbkcStatusUpdated',$nppbkc);
        // $this->closeModal();
        $this->closeModalWithEvents([
            Message::getName() => ['nppbkcFlashMessage', [true]]
            ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
        ]);
    }

    public function keputusan_tolak()
    {
        return $this->keputusan(0);
    }

    public function keputusan($setuju)
    {
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        if($setuju==0)
            $nppbkc->status_nppbkc=4;
        else
            $nppbkc->status_nppbkc=5;
        if($nppbkc->isDirty()){
            // dd('changed');
            $nppbkc->save();
            $alertFlash = false;
            if($setuju==0){
                $alertFlash = true;
                session(['message' => 'Permohonan cek lokasi telah ditolak.']);
                $notif['error']='';
            }
            else
                session(['message' => 'Permohonan cek lokasi telah disetujui.']);
            
            $url = route('nppbkc.view',[$nppbkc->id]);

            $notif = [
                'greeting' => 'Hi '.$nppbkc->createdBy->name,
                'message' =>'Permohonan NPPBKC anda dengan dengan no '.$nppbkc->no_permohonan.',  telah '.($setuju==0?"ditolak":"disetujui"),
                'text' => "Permohonan NPPBKC ".($setuju==0?"ditolak":"disetujui"),
                'content' =>"*Permohonan NPPBKC no ".$nppbkc->no_permohonan.', telah '.($setuju==0?"ditolak":"disetujui")." oleh ".\Auth::user()->name.'*',
                'url_title'=>'Cek Permohonan',
                'url' =>$url
            ];

            try{
                $nppbkc->notify(new NppbkcUpdatedNotification($notif));
            }catch (\Exception $e) {
                \Sentry\captureException($e);
            }

            // $this->emit('nppbkcStatusUpdated',$nppbkc);
            // $this->closeModal();
            $this->closeModalWithEvents([
                Message::getName() => ['nppbkcFlashMessage', [$alertFlash]]
                ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
            ]);
        }else{
            $this->closeModal();
        }
    }

    private function buildData(){
        $arr = [];
        $str = '';
        //dd($this->province_id);
        foreach($this->rules as $field=>$val){
            if(!isset($this->{$field})||$this->{$field}==null||$this->{$field}=='') continue;
            $this->{$field}=trim($this->{$field});
            if (strpos($field, '_from') !== false||strpos($field, '_to') !== false||strpos($field, 'tanggal') !== false) {
                $arr[$field] = Carbon::createFromFormat('d-m-Y', $this->{$field})->format('Y-m-d');
            }
        }
        
        return $arr;
    }

    public function complete()
    {
        $this->validate();
        try {
            $nppbkc=Nppbkc::findOrFail($this->nppbkc_id);
            
            foreach($this->petugas_files as $name=>$title){
                if($this->{$name}!=null){
                    $filename = $this->{$name}->storeAs('nppbkc/'.$nppbkc->id, $name.'.'.$this->{$name}->extension());
                    $originalname = $this->{$name}->getClientOriginalName();
                    $size = $this->{$name}->getSize();
                    $annotationFileName = 'annotation.'.str_replace("file_","",$name);
                    $annotationFiles = $nppbkc->annotationFiles()->OfName($annotationFileName);
                    $count = $annotationFiles->count();
                    if($count==1){
                        $annotationFile =$annotationFiles->first();
                        $hash = md5($annotationFileName.$nppbkc->id);
                        $annotationFile->update([
                            'key'=>$hash,
                            'name'=>$annotationFileName,
                            'title'=>$title,
                            'filename'=>$filename,
                            'original_filename'=>$originalname,
                            'size'=>$size,
                            'is_annotation'=>1,
                            'ext'=>$this->{$name}->extension()
                        ]);
                    }
                    else{
                        if($count>0){
                            $annotationFiles->delete();
                        }
                        $hash = md5($annotationFileName.$nppbkc->id);
                        $annotationFile = new NppbkcFile([
                            'key'=>$hash,
                            'name'=>$annotationFileName,
                            'title'=>$title,
                            'filename'=>$filename,
                            'original_filename'=>$originalname,
                            'size'=>$size,
                            'is_annotation'=>1,
                            'ext'=>$this->{$name}->extension()
                        ]);
                        $nppbkc->files()->save($annotationFile);
                    }
                }
            }

            $nppbkc->status_nppbkc=3;
            // while(Nppck::where('no_permohonan','=',$nppbkc->no_permohonan)->count()>0){
            //     $nppbkc->no_permohonan = str_pad($no++,6,"0",STR_PAD_LEFT).'/'.
            //     str_replace(' ','_',strtoupper($data['nama_usaha'])).'/'.$bln.'/'.date('Y');
            // }
            $no = Nppbkc::whereNotNull('no_permohonan_nppbkc')->orderByDesc('id')->first();
            if($no!=null){
                $no = (int)explode('/', $no->no_permohonan_nppbkc)[0];
            }else{
                $no=0;
            }
            $nppbkc->no_permohonan = 'TTD-'.str_pad($no+1,6,"0",STR_PAD_LEFT).'/WBC.15/KPP.MP.04/'.date('Y');
            $nppbkc->catatan_petugas=$this->catatan_petugas;
            $nppbkc->no_ba_cek_lokasi=$this->no_ba_cek_lokasi;
            
            $nppbkc->tanggal_ba_cek_lokasi=Carbon::createFromFormat('d-m-Y', trim($this->tanggal_ba_cek_lokasi))->format('Y-m-d');
            $nppbkc->save();

            $data = [
                'status_nppbkc'=>$nppbkc->status_nppbkc,
                'catatan_petugas'=>$nppbkc->catatan_petugas
            ];
            $nppbkc->annotations()->save(new NppbkcAnnotation($data));

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
                $replaces[]='<strong>'.$annotationDate .'</strong>';
                $formats[]='[NO_BA_CEK_LOKASI]';
                $replaces[]='<strong>'.$this->no_ba_cek_lokasi.'</strong>';
                $formats[]='[TANGGAL_BA_CEK_LOKASI]';
                $replaces[]='<strong>'.$this->tanggal_ba_cek_lokasi.'</strong>';
            }

            //replace all
            $pdfHTML = str_replace($formats,$replaces,$pdfHTML);
    
            $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_nppbkc.pdf';
            $hash = md5('file-permohonan-nppbkc'.$nppbkc->id);
            $url = url('/nppbkc/download-file/'.$hash);
            $qrImage= base64_encode(
                QrCode::format('png')
                ->size(80)
                ->generate($url)
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
                                    'is_annotation'=>2,
                                    'ext'=>'pdf'
                                ])
                            );
            $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
            Storage::put($pdf_filename, $pdf->output());

            $url = route('nppbkc.view',[$nppbkc->id]);

            $notif = [
                'greeting' => 'Hi '.$nppbkc->createdBy->name,
                'text' => "Permohonan NPPBKC ".$nppbkc->no_permohonan,
                'message' =>'Bersamaan dengan email ini, kami mengirimkan attachment salinan surat permohonan anda dengan no '.$nppbkc->no_permohonan.', selanjutnya anda tinggal menunggu hasil keputusan yang juga dapat dipantau melalui link dibawah',
                'content' =>"*Permohonan no ".$nppbkc->no_permohonan.", telah diupdate oleh ".\Auth::user()->name."*",
                'url_title'=>'Cek Permohonan',
                'url' =>$url,
                'filepath'=>$nppbkc->files()->OfName('surat_permohonan_nppbkc')->first()->filename,
                'filename'=>$nppbkc->id.'_surat_permohonan_nppbkc.pdf'
            ];

            try{
                $nppbkc->notify(new NppbkcUpdatedNotification($notif));
            }catch (\Exception $e) {
                \Sentry\captureException($e);
            }

            session(['message' => 'Data telah diupdate ke status Permohonan NPPBKC.']);
            
            $this->closeModalWithEvents([
                Message::getName() => ['nppbkcFlashMessage', [false]]
                ,\App\Http\Livewire\Nppbkc\Annotation\View::getName() => ['annotationUpdated', [$nppbkc->id]]
                ,\App\Http\Livewire\Nppbkc\Annotation\TabHeader::getName() => ['annotationUpdated',[true]]
                ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
            ]);
        }catch (\Exception $e) {
            Sentry\captureException($e);
        }
    }
}
