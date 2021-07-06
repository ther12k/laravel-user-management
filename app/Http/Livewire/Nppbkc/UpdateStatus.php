<?php

namespace App\Http\Livewire\Nppbkc;

use Livewire\Component;
use App\Models\Nppbkc;

class UpdateStatus extends Component
{ 
    public $nppbkc;

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
    }

    
    public function render()
    {
        return view('livewire.nppbkc.update-status');
    }
}
