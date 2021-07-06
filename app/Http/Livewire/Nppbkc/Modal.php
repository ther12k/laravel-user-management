<?php

namespace App\Http\Livewire\Nppbkc;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

use Livewire\WithFileUploads;
use App\Models\Nppbkc;
use App\Models\NppbkcFile;
use App\Models\NppbkcAnnotation;

use App\Notifications\NppbkcAddedNotification;
use PDF,Storage,QrCode;

class Modal extends ModalComponent
{
    use WithFileUploads;
    public $nppbkc_id,$status_nppbkc,$catatan_petugas,$file_surat_tugas,$file_ba_periksa,$file_ba_wawancara;
    //tambahan 6 juli 2021
    public $no_ba_periksa,$tanggal_ba_periksa;
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
        $nppbkc->save();
        session(['message' => 'Permohonan cek lokasi telah disetujui, silahkan melanjutkan cek lokasi.']);
        // $this->emit('nppbkcStatusUpdated',$nppbkc);
        // $this->closeModal();
        $this->closeModalWithEvents([
            Message::getName() => ['nppbkcFlashMessage', [false]]
            ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
        ]);
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
            }
            else
                session(['message' => 'Permohonan cek lokasi telah disetujui.']);
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
        try {
            $this->validate($this->rules);
            $nppbkc=Nppbkc::findOrFail($this->nppbkc_id);
            
            foreach($this->petugas_files as $name=>$title){
                if($this->{$name}!=null){
                    $filename = $this->{$name}->storeAs('nppbkc/'.$nppbkc->id, $name.'.'.$this->{$name}->extension());
                    $originalname = $this->{$name}->getClientOriginalName();
                    $size = $this->{$name}->getSize();
                    $annotationName = 'annotation.'.str_replace("file_","",$name);
                    $annotationFiles = $nppbkc->annotationFiles()->OfName($annotationName);
                    $count = $annotationFiles->count();
                    if($count==1){
                        $annotationFile =$annotationFiles->first();
                        $annotationFile->update([
                            'name'=>$annotationName,
                            'title'=>$title,
                            'filename'=>$filename,
                            'original_filename'=>$originalname,
                            'size'=>$size
                        ]);
                    }
                    else{
                        if($count>0){
                            $this->consoleLog($count);
                            $annotationFiles->delete();
                        }
                        $annotationFile = new NppbkcFile([
                            'name'=>$annotationName,
                            'title'=>$title,
                            'filename'=>$filename,
                            'original_filename'=>$originalname,
                            'size'=>$size,
                            'is_annotation'=>1
                        ]);
                        $nppbkc->files()->save($annotationFile);
                    }
                }
            }

            $pdfHTML = view('pdf.permohonan_nppbkc')->render();
            $formats=[];
            $replaces=[];
            foreach($nppbkc->toArray() as $key=>$val){
                if(isset($val)){
                    $formats[]='['.strtoupper($key).']';
                    if($key=='nama_usaha')
                        $val=strtoupper($val);
                    $replaces[]=$val;
                }
            }

            $pdfHTML = str_replace($formats,$replaces,$pdfHTML);
            
            //generate auto number
            //TTD-000001/WBC.15/KPP.MP.04/2021

            $nppbkc->no_permohonan = 'TTD-'.str_pad($nppbkc->id,6,"0",STR_PAD_LEFT).'/WBC.15/KPP.MP.04/'.date('Y');
            // while(Nppck::where('no_permohonan','=',$nppbkc->no_permohonan)->count()>0){
            //     $nppbkc->no_permohonan = str_pad($no++,6,"0",STR_PAD_LEFT).'/'.
            //     str_replace(' ','_',strtoupper($data['nama_usaha'])).'/'.$bln.'/'.date('Y');
            // }
            $nppbkc->status_nppbkc=3;
            $nppbkc->catatan_petugas=$this->catatan_petugas;
            $nppbkc->save();

            $data = [
                'status_nppbkc'=>$nppbkc->status_nppbkc,
                'catatan_petugas'=>$nppbkc->catatan_petugas
            ];

            $annotation = $nppbkc->annotations()->OfStatus($nppbkc->status_nppbkc);
            
            if($annotation->count()==0){
                $nppbkc->annotations()->save(new NppbkcAnnotation($data));
            }else{
                $annotation->update($data);
            }

            $pdfHTML = str_replace('[NO_PERMOHONAN]',$nppbkc->no_permohonan,$pdfHTML);

            $qrImage= base64_encode(
                QrCode::format('png')->merge('http://w3adda.com/wp-content/uploads/2019/07/laravel.png', 0.2, true)
                ->size(100)->errorCorrection('H')
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
            if($nppbkc->files())
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
            $this->consoleLog('success');
            $url = url($pdf_filename);
            $nppbkc->notify(new NppbkcAddedNotification([
                'text' => "Permohonan NPPBKC baru ".$nppbkc->id,
                'content' =>"*Permohonan baru, no ".$nppbkc->no_permohonan."* [Lihat](http://www.google.com)",
                'filename' =>$pdf_filename,
                'url' =>$pdf_filename
            ]));

            session(['message' => 'Data telah diupdate ke status Permohonan NPPBKC.']);
            $this->closeModalWithEvents([
                Message::getName() => ['nppbkcFlashMessage', [false]]
                ,NppbkcAnnotationView::getName() => ['annotationUpdated', [$nppbkc->id]]
                ,NppbkcAnnotationTabHeader::getName() => ['annotationUpdated',[true]]
                ,UpdateStatus::getName() => ['nppbkcStatusUpdated', [$nppbkc]]
            ]);
        }catch (\Exception $e) {
            dd($e);
        }
    }
}
