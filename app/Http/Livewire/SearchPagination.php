<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Nppbkc;

class SearchPagination extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $search = '%'.$this->search.'%';
        return view('livewire.search-pagination',[
        'nppbkcs' => Nppbkc::where('nama_pemilik', 'like',$search)->paginate(5)
        ])->layout('livewire.home');
    }
}
