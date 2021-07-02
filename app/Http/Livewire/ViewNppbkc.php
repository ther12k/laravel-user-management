<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nppbkc;
use Auth;

class ViewNppbkc extends Component
{
    public $newid;

    public function mount($id)
    {
        $this->newid = $id;
    }
    public function render()
    {
        $nppbkc = Nppbkc::find($this->newid);
        if($nppbkc==null) abort(404);
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
        $this->newid = $id;
    }
}
