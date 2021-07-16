<?php

namespace App\Http\Livewire\Nppbkc\Form;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Livewire\Component;

class EditField extends Component
{
    public $value;
    public $nppbkcId;
    public $newVal;
    public $oriVal;
    public $isChanged;
    public $isVal; // determines whether to display it in bold text
    public string $field; // this is can be column. It comes from the blade-view foreach($fields as $field)
    public string $model='App\Models\Nppbkc'; // Eloquent model with full name-space

    public function mount($nppbkcId,$field,$value)
    {
        $this->newVal = $value;
        $this->oriVal = $value;
        $nppbkc = session('nppbkc');
        $this->isChanged = $nppbkc[$field]!==$value;
        // $this->init(); // initialize the component state
    }

    public function updated()
    {
        // dd($newVal);
        // $this->newVal = trim($newVal);
        $this->value = trim($this->newVal) ?? null;
        $nppbkc = session('nppbkc');
        $nppbkc[$this->field] = $this->value;
        session(['nppbkc'=>$nppbkc]);
        $this->isChanged = $this->oriVal!==$this->value;
        //$this->emitUp('valueEdited',$this->field,$this->value);
    }

    public function render()
    {
        return view('livewire.nppbkc.form.edit-field');
    }
}
