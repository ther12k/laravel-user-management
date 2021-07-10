<?php

namespace App\Http\Livewire\Nppbkc\Form;

use Illuminate\Support\Str;
use Livewire\Component;

class EditField extends Component
{
    public $value;
    public $nppbkcId;
    public $newVal;
    public $isVal; // determines whether to display it in bold text
    public string $field; // this is can be column. It comes from the blade-view foreach($fields as $field)
    public string $model='App\Models\Nppbkc'; // Eloquent model with full name-space

    public function mount($nppbkcId,$field,$value)
    {
        $entity = $this->model::findOrFail($this->nppbkcId);
        $this->init($entity); // initialize the component state
    }

    public function save()
    {
        $entity = $this->model::findOrFail($this->nppbkcId);
        $newVal = trim($this->newVal);
       
        $entity->{$this->field} = $newVal ?? null;
        $entity->save();
        $this->init($entity); // re-initialize the component state with fresh data after saving
        //$this->dispatchBrowserEvent('notify', Str::studly($this->field).' successfully updated!');
    }

    private function init($entity)
    {
        $this->value = $entity->{$this->field};
        $this->newVal = $this->value;
        $this->isVal = $entity->{$this->field} ?? false;
    }

    public function render()
    {
        return view('livewire.nppbkc.form.edit-field');
    }
}
