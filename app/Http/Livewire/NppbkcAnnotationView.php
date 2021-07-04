<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;

class NppbkcAnnotationView extends Component
{
    public $files,$annotation; 
    protected $listeners = [
        'annotationUpdated' => 'refresh',
    ];

    //nppbkc id
    public function refresh($id)
    {
        $nppbkc = Nppbkc::find($id);
        $this->files = $nppbkc->annotationFiles()->get();
        $this->annotation = $nppbkc->annotations()->orderByDesc('id')->first();
    }
    //nppbkc id
    public function mount($id)
    {
        $nppbkc = Nppbkc::find($id);
        $this->files = $nppbkc->annotationFiles()->get();
        $this->annotation = $nppbkc->annotations()->orderByDesc('id')->first();
    }

    public function render()
    {
        return view('livewire.nppbkc-annotation-view');
    }
}
