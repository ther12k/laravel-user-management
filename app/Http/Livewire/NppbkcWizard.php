<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NppbkcWizard extends Component
{
    use WithFileUploads;

    public $step = 0, $status_nppbkc = 1;
    public $status_pemohon='sendiri', $nama_pemilik, $alamat_pemilik,$email_pemilik,$telp_pemilik,$npwp_pemilik='xx.xxx.xxx.x-xxx.xxx';
    public $jenis_usaha_bkc,$jenis_bkc; 
    public $nama_usaha, $alamat_usaha,$email_usaha,$telp_usaha,$npwp_usaha='xx.xxx.xxx.x-xxx.xxx';
    public $jenis_lokasi,$lokasi,$kegunaan; 
    public $province_id,$regency_id,$district_id,$village_id; 
    public $file_denah_bangunan,$file_denah_lokasi,$file_izin_instansi,$file_surat_kuasa,$file_nib;
    public $file_npwp_pemilik,$file_npwp_usaha,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
    public $successMessage = '';

    protected $rules = [
        [],
        [
            'status_pemohon' => 'required',
            'nama_pemilik' => 'required|min:4',
            'alamat_pemilik' => 'required|min:5',
            'telp_pemilik' => 'required',
            //xx.xxx.xxx.x-xxx.xxx
            'npwp_pemilik' => 'required|regex:/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}.[0-9]-[0-9]{3}\.[0-9]{3}$/',
            'email_pemilik' => 'required|email:filter'
        ],
        [
            'jenis_usaha_bkc' => 'required',
            'jenis_bkc' => 'required',
        ],
        [
            'nama_usaha' => 'required|min:4',
            'alamat_usaha' => 'required',
            'telp_usaha' => 'required',
            //xx.xxx.xxx.x-xxx.xxx
            'npwp_usaha' => 'required|regex:/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}.[0-9]-[0-9]{3}\.[0-9]{3}$/',
            'email_usaha' => 'required|email:filter'
        ],
        [
            'jenis_lokasi' => 'required',
            'lokasi' => 'required|min:5',
            'kegunaan' => 'required'
        ],
        [
            'village_id' => 'required',
        ],
    ];

    protected $messages = [
        'nama_pemilik.required' => 'Nama tidak boleh kosong.',
        'alamat_pemilik.required' => 'Alamat tidak boleh kosong.',
        'telp_pemilik.required' => 'No Telp tidak boleh kosong.',
        'alamat_pemilik.required' => 'Alamat tidak boleh kosong.',
        'npwp_pemilik.required' => 'NPWP tidak boleh kosong.',
        'npwp_pemilik.regex' => 'NPWP tidak valid.',
        'email_pemilik.required' => 'email tidak boleh kosong.',
        'email_pemilik.email' => 'Format email salah.',

        'jenis_usaha_bkc.required' => 'Pilih jenis usaha BKC.',
        'jenis_bkc.required' => 'Pilih jenis BKC.',

        'nama_usaha.required' => 'Nama tidak boleh kosong.',
        'alamat_usaha.required' => 'Alamat tidak boleh kosong.',
        'telp_usaha.required' => 'No Telp tidak boleh kosong.',
        'alamat_usaha.required' => 'Alamat tidak boleh kosong.',
        'npwp_usaha.required' => 'NPWP tidak boleh kosong.',
        'npwp_usaha.regex' => 'NPWP tidak valid.',
        'email_usaha.required' => 'email tidak boleh kosong.',
        'email_usaha.email' => 'Format email salah.',

        'jenis_lokasi.required' => 'Pilih jenis lokasi.',
        'lokasi.required' => 'Lokasi tidak boleh kosong.',
        'kegunaan.required' => 'Pilih kegunaan lokasi.',


        'village_id.required' => 'Alamat belum lengkap.',

    ];


    public function mount(){

        //test
        $this->nama_pemilik='test';
        $this->alamat_pemilik='teseet';
        $this->telp_pemilik='12345';
        $this->npwp_pemilik='11.111.111.1-111.111';
        $this->email_pemilik='rizkyz@gmail.com';


        $this->nama_usaha='test';
        $this->alamat_usaha='3test';
        $this->telp_usaha='12345';
        $this->npwp_usaha='11.111.111.1-111.111';
        $this->email_usaha='rizkyz@gmail.com';
        $this->lokasi='lokasi';
    }

    public function render()
    {


        return view('livewire.wizard')->extends('layouts.auth');
    }
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,$this->rules[$this->step]);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stepCheck()
    {   
        if(0<$this->step&&$this->step<11){
            $validatedData = $this->validate($this->rules[$this->step]);
            $this->step++;
        }else if($this->step==0){
            $this->step=1;
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'stock' => 'required',
            'status' => 'required',
        ]);
  
        $this->currentStep = 3;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {
        Product::create([
            'name' => $this->name,
            'amount' => $this->amount,
            'description' => $this->description,
            'stock' => $this->stock,
            'status' => $this->status,
        ]);
  
        $this->successMessage = 'Product Created Successfully.';
  
        $this->clearForm();
  
        $this->step = 1;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back()
    {
        $this->step--;    
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->name = '';
        $this->amount = '';
        $this->description = '';
        $this->stock = '';
        $this->status = 1;
    }

}
