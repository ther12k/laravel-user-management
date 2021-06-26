<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class NppbkcWizard extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $status_pemohon='sendiri', $nama_pemilik, $alamat_pemilik, $status_nppbkc = 1;
    public $file_denah_bangunan,$file_denah_lokasi,$file_izin_instansi,$file_surat_kuasa,$file_nib;
    public $file_npwp_pemilik,$file_npwp_perusahaan,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
    public $successMessage = '';

    protected $step1_rules = [
        'status_pemohon' => 'required',
        'nama_pemilik' => 'required',
        'alamat_pemilik' => 'required'
    ];

    protected $messages = [
        'nama_pemilik.required' => 'Nama Pemilik tidak boleh kosong.',
        'alamat_pemilik.required' => 'Alamat Pemilik tidak boleh kosong.'
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

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {   
        $validatedData = $this->validate($this->step1_rules);
 
        $this->currentStep = 2;
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
  
        $this->currentStep = 1;
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;    
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
