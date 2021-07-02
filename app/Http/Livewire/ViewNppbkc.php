<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;
use Auth;

class ViewNppbkc extends Component
{
    public $nppbkc_id;
    public $isOpen=false;

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
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function closeModal()
    {
        $this->isOpen = false;
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
                'files'=>$nppbkc->files->all()
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
