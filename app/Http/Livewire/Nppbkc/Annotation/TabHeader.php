<?php

namespace App\Http\Livewire\Nppbkc\Annotation;

use Livewire\Component;

class TabHeader extends Component
{
    public $show;

    protected $listeners = [
        'annotationUpdated' => 'refresh',
    ];

    public function refresh($show){
        $this->show = $show;
    }

    public function mount($show){
        $this->show = $show;
    }
    public function render()
    {
        return view('livewire.nppbkc.annotation.tab-header');
    }
}