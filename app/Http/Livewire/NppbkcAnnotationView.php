<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;

class NppbkcAnnotationView extends Component
{
    public $files,$catatan_petugas; 
    protected $listeners = [
        'annotationUpdated' => 'refresh',
    ];

    //nppbkc id
    public function refresh($id)
    {
        $nppbkc = Nppbkc::find($id);
        $this->files = $nppbkc->annotationFiles()->get();
        $this->catatan_petugas = $nppbkc->catatan_petugas;
    }
    //nppbkc id
    public function mount($id)
    {
        $nppbkc = Nppbkc::find($id);
        $this->files = $nppbkc->annotationFiles()->get();
        $this->catatan_petugas = $nppbkc->catatan_petugas;
        //dd($this->annotation);
    }

    public function render()
    {
        return view('livewire.nppbkc-annotation-view');
    }
}
