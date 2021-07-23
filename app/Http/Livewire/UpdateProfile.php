<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use Spatie\Activitylog\Traits\LogsActivity;
use DigitalCloud\Blameable\Traits\Blameable;

use App\Models\UserProfile;
use App\Models\UserFile;
use Auth;
class UpdateProfile extends Component
{
    use WithFileUploads;
    public $file_npwp,$file_ktp,$file_registrasi_pengusaha_bkc;
    public $has_profile=false,$alamat,$pekerjaan,$no_telp,$nama;
    protected $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'pekerjaan' => 'required',
        'no_telp' => 'required',
        'file_npwp' => 'required',
        'file_ktp' => 'required',
        'file_registrasi_pengusaha_bkc' => 'required'
    ];

    protected $messages = [
        'nama.required' => 'Nama tidak boleh kosong.',
        'alamat.required' => 'Alamat tidak boleh kosong.',
        'no_telp.required' => 'No Telp tidak boleh kosong.',
        'pekerjaan.required' => 'Pekerjaan tidak boleh kosong.',
        'file_npwp.required' => 'NPWP harus diupload.',
        'file_ktp.required' => 'KTP harus diupload.'
    ];

    public function mount(){
        $user = Auth::user();
        if(!$user->hasProfile){
            $this->nama = $user->name;
        }else{
            if($user->hasUserProfile){
                $profile = $user->profile;
                $this->has_profile = true;
                $this->nama = $profile->nama;
                $this->pekerjaan = $profile->pekerjaan;
                $this->no_telp = $profile->no_telp;
                $this->alamat = $profile->alamat;
            }
        }
    }

    public function render()
    {
        return view('livewire.update-profile')->extends('layouts.auth');
    }

    public function updated($field,$value)
    {
        
        $this->validateOnly($field);
    }

    public function update()
    {
        $this->validate();
        $user = Auth::user();
        if(!$user->hasProfile){
            $profile = UserProfile::create([
                'nama'=>$this->nama,
                'alamat'=>$this->alamat,
                'pekerjaan'=>$this->pekerjaan,
                'no_telp'=>$this->no_telp,
            ]);
            $profile->user()->save($user);
            session()->flash('message', 'Profile telah diisi');
        }else{
            if(!$user->hasUserProfile){
                $profile = $user->profile;
                $profile->update([
                    'nama'=>$this->nama,
                    'alamat'=>$this->alamat,
                    'pekerjaan'=>$this->pekerjaan,
                    'no_telp'=>$this->no_telp,
                ]);
            }
            session()->flash('message', 'Profile telah diupdate');
        }

        if($user->hasUserProfile){
            foreach($this->rules as $name=>$value){
                if(strpos($name,'file')!== false){
                    $filename = $this->{$name}->storeAs($user->id, $user->id.'_'.$name.'.'.$this->{$name}->extension(),'user');
                    $originalname = $this->{$name}->getClientOriginalName();
                    $size = $this->{$name}->getSize();
                    $hash = md5($name.$user->id);
                    $file = new UserFile([
                        'key'=>$hash,
                        'name'=>$name,
                        'title'=>$name,
                        'filename'=>$filename,
                        'original_filename'=>$originalname,
                        'size'=>$size,
                        'ext'=>$this->{$name}->extension()
                    ]);
                    $user->files()->save($file);
                }
            }
        }
        $user->name = $this->nama;
        $user->save();
        return redirect()->route('home');
        // $profile = App\UserProfile::create(['address1'=>'Lilac Cottage','address2'=>'Leeming Lane'])
        // $profile->user()->save(User::find(2))
    }
}
