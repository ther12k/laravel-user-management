<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfile extends Component
{
    use WithFileUploads;
    public $npwp_photo;
    public $ktp_photo;
    public function render()
    {
        return view('livewire.update-profile');
    }
}
