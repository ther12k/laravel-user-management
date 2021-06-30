<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;

class ViewNppbkc extends Component
{
    public $newid;
    public function render()
    {
        $nppbkc = Nppbkc::findOrFail($this->newid);
        return view('livewire.nppbkc',$nppbkc->toArray());
    }
    public function mount($id)
    {
        $nppbkc = Nppbkc::findOrFail($id);
        $this->newid = $nppbkc->id;
    }
}
