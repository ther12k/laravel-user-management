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
    public $isOpen=false;
    public $catatan_petugas;
    public $file_surat_tugas,$file_ba_periksa,$file_ba_wawancara;
    public $activeTab=1;
    public $inactiveClass='hover:text-purple-600 bg-gray-300 text-gray-600 bg-white text-xs font-bold uppercase px-5 py-3 block leading-normal';
    public $activeClass='text-purple-600 bg-white text-xs font-bold uppercase px-5 py-3 block leading-normal';

    public $petugas_files=[
        'file_surat_tugas'=>'Surat tugas periksa lokasi',
        'file_ba_periksa'=>'Berita acara periksa lokasi',
        'file_ba_wawancara'=>'Berita acara wawancara'
    ];

    public function mount($id)
    {
        $this->nppbkc_id = $id;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function openModal()
    {
        $this->isOpen = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
        $this->dispatchBrowserEvent('showMap');
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
                'files'=>$nppbkc->files->all(),
                'petugas_files'=>$this->petugas_files
            ]
        );
        
        return view('livewire.nppbkc',$data);
    }


    public function openmap()
    {
        $this->nppbkc_id = $id;
    }

    public function setuju_cek()
    {
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        $nppbkc->status_nppbkc=2;
        $nppbkc->save();
        session()->flash('message', 'Permohonan cek lokasi telah disetujui, silahkan melanjutkan cek lokasi.');
        $this->closeModal();
    }
}
