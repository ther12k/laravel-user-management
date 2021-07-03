<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;

class NppbkcUpdateStatus extends Component
{ 
    public $nppbkc,$message;

    public function mount(Nppbkc $nppbkc)
    {
        $this->nppbkc = $nppbkc;
    }

    protected $listeners = [
        'nppbkcStatusUpdated' => 'update',
        'openUpdateNppbkcModal'=>'openUpdateNppbkcModal'
    ];

    public function update(Nppbkc $nppbkc)
    {
        $this->nppbkc = $nppbkc;
        if(session()->has('message')){
            $this->message = session('message');
        }
    }

    
    public function render()
    {
        return view('livewire.nppbkc-update-status');
    }
}
