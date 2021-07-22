<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Barryvdh\Debugbar\Facade as Debugbar;
use LivewireUI\Modal\ModalComponent;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Hash;

class UserModal extends ModalComponent
{
    public $action;
    public $user_id,$name,$email,$role,$user,$password;

    public function rules()
    {
        // if($this->user_id=null)
        //     return [
        //         'name' => 'required',
        //         'email' => 'required|email|max:255|unique:users,email',
        //         'password' => 'required|min:8',
        //     ];
        return [
            'name' => 'required',
            'email' => 'required|email|max:255|unique:nppbkc_users,email,'.$this->user_id,
            'password' => 'sometimes|nullable|min:8',
        ];
    }

    public function mount($id,$action='edit')
    {
        $this->action = $action;
        if(isset($id)){
            $this->user_id = $id;
            $this->user = $user = User::findOrFail($id);
            $this->name=$user->name;
            $this->email=$user->email;
            $this->role=$user->role;
        }
    }


    public function resend(){
        if($this->user->email_verified_at==null)  
            event(new Registered($this->user));
        $this->closeModalWithEvents([
        ]);
    }

    public function delete(){
        $this->user->delete();
        $this->closeModalWithEvents([
            Users::getName() =>'refresh'
        ]);
    }

    public function verify(){
        if($this->user->email_verified_at==null){
            $this->user->email_verified_at = now();
            $this->user->save();
        }
        
        $this->closeModalWithEvents([
            Users::getName() =>'refresh'
        ]);
    }

    public function edit()
    {
        $this->validate();
        $data = [
            'name'=>$this->name,
            'email'=>$this->email
        ];
        if($this->password!=null){
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);
        // $user = User::create([
        //     'email' => $this->email,
        //     'name' => $this->name,
        //     'role' =>$this->role,
        //     'password' => Hash::make($this->password),
        // ]);
        $this->closeModalWithEvents([
            Users::getName() =>'refresh'
        ]);
    }

    public function add()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'role' =>$this->role,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        $this->closeModalWithEvents([
            Users::getName() =>'refresh'
        ]);
    }

    public function render()
    {
        return view('livewire.user-modal');
    }
}
