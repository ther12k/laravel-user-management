<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Nppbkc;
use Auth;

class ViewNppbkc extends Component
{
    use WithFileUploads;
    public $nppbkc_id;
    public $petugas_files=[
        'file_surat_tugas'=>'Surat tugas periksa lokasi',
        'file_ba_periksa'=>'Berita acara periksa lokasi',
        'file_ba_wawancara'=>'Berita acara wawancara'
    ];

    public function mount($id)
    {
        $this->nppbkc_id = $id;
    }
    
    public function render()
    {
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        //if($nppbkc==null) abort(404);
        if(!\Gate::allows('viewAllNppbkc')){
            if($nppbkc->created_by!=Auth::user()->id){
                abort(401);
            }
        }
        
        $data = array_merge($nppbkc->toArray(),
            [
                'files'=>$nppbkc->nppbkcFiles->all(),
                'file_surat_permohonan_lokasi'=>$nppbkc->files()->OfName('surat_permohonan_lokasi')->orderByDesc('id')->first(),
                'file_surat_permohonan_nppbkc'=>$nppbkc->files()->OfName('surat_permohonan_nppbkc')->orderByDesc('id')->first(),
                'petugas_files'=>$nppbkc->annotationFiles->all(),
            ]
        );
        return view('livewire.nppbkc',$data);
    }


    public function openmap()
    {
        $this->nppbkc_id = $id;
    }
}
