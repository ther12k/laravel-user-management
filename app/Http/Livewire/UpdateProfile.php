<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

use Spatie\Activitylog\Traits\LogsActivity;
use DigitalCloud\Blameable\Traits\Blameable;

use App\Models\UserProfile;
use Auth;
class UpdateProfile extends Component
{
    use WithFileUploads;
    public $file_npwp,$file_ktp;
    public $has_profile=false,$alamat,$pekerjaan,$no_telp,$nama,$file_registrasi_pengusaha_bkc;
    protected $rules = [
        'nama' => 'required',
        'alamat' => 'required',
        'pekerjaan' => 'required',
        'no_telp' => 'required',
        'file_npwp' => 'required',
        'file_ktp' => 'required',
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
        return view('livewire.update-profile');
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
        $user->name = $this->nama;
        $user->save();
        return redirect()->route('home');
        // $profile = App\UserProfile::create(['address1'=>'Lilac Cottage','address2'=>'Leeming Lane'])
        // $profile->user()->save(User::find(2))
    }
}
