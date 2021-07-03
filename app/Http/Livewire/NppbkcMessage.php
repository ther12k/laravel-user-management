<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NppbkcMessage extends Component
{
    public $alert = false;    
    protected $listeners = [
        'nppbkcFlashMessage' => 'show_message',
        'nppbkcCloseFlashMessage' => 'closeMessage'
    ];

    function show_message($isAlert){
        $this->alert = $isAlert;
    }

    public function close_message(){
    }

    public function render()
    {
        return view('livewire.nppbkc-message');
    }
}
