<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use Spatie\Activitylog\Traits\LogsActivity;
use DigitalCloud\Blameable\Traits\Blameable;

use Auth,Hash;

class UpdatePassword extends Component
{
    
    public $oldPassword,$password,$passwordConfirmation,$message;

    public function mount(){
    }

    public function render()
    {
        return view('livewire.update-password')->extends('layouts.auth');
    }

    public function updatePassword()
    {
        $this->message = "";
        $this->validate([
            'oldPassword'     => 'required',
            'password'     => 'required|min:8',
            'passwordConfirmation' => 'required|same:password',
        ]);
        
        $user = Auth::user();
     
        if(!Hash::check($this->oldPassword, $user->password)){
            $this->addError('oldPassword', trans('passwords.wrong'));
        }else{
            if($this->oldPassword==$this->password){
                
                $this->addError('password', trans('passwords.same-with-new'));
            }else{
                $user->password =  Hash::make($this->password);
                $user->save();
                $this->oldPassword = '';
                $this->password = '';
                $this->passwordConfirmation = '';
                $this->message = "Password sudah diupdate";
            }
        }
    }
}
