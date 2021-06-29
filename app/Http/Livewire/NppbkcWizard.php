<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Nppbkc;
use App\Models\NppbkcFile;


use Carbon\Carbon;

class NppbkcWizard extends Component
{
    use WithFileUploads;

    public $step = 0, $status_nppbkc = 1;
    public $status_pemohon='sendiri', $nama_pemilik, $alamat_pemilik,$email_pemilik,$telp_pemilik,$npwp_pemilik='xx.xxx.xxx.x-xxx.xxx';
    public $jenis_usaha_bkc,$jenis_bkc; 
    public $nama_usaha, $alamat_usaha,$email_usaha,$telp_usaha,$npwp_usaha='xx.xxx.xxx.x-xxx.xxx';
    public $jenis_lokasi,$lokasi,$kegunaan; 
    public $province,$regency,$district,$village;
    public $province_id,$regency_id,$district_id,$village_id; 
    public $rt_rw,$alamat,$lokasi_geo,$lokasi_latitude,$lokasi_longitude;
    public $no_siup_mb,$masa_berlaku_siup_mb_from,$masa_berlaku_siup_mb_to,$masa_berlaku_itp_mb_from,$masa_berlaku_itp_mb_to,$no_itp_mb,$no_izin_nib,$tanggal_nib;
    public $tanggal_kesiapan_cek_lokasi;
    public $file_denah_bangunan,$file_denah_lokasi,$file_siup_mb,$file_itp_mb,$file_surat_kuasa;
    public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
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
        [
            'rt_rw' =>'required',
            'alamat' =>'required'
        ],
        [
            'no_siup_mb'=>'required',
            'masa_berlaku_siup_mb_from'=>'required',
            'masa_berlaku_siup_mb_to'=>'required',
            'no_itp_mb'=>'required',
            'masa_berlaku_itp_mb_from'=>'required',
            'masa_berlaku_itp_mb_to'=>'required',
            'no_izin_nib'=>'required',
            'tanggal_nib'=>'required'
        ],
        [
            'tanggal_kesiapan_cek_lokasi'=>'required'
        ],
        [
            'file_denah_bangunan'=>'required',
            'file_denah_lokasi'=>'required',
            'file_siup_mb'=>'required',
            'file_itp_mb'=>'required',
            'file_nib'=>'required',
            'file_npwp_usaha'=>'required'
        ],
        [
            'file_npwp_pemilik'=>'required',
            'file_ktp_pemilik'=>'required',
            'file_surat_pernyataan'=>'required',
            'file_data_registrasi'=>'required'
        ],
        //public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
    
    ];
    //protected $rules = null;
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

        'rt_rw.required' => 'RT/RW belum diisi.',
        'alamat.required' => 'Alamat lengkap belum diisi.',

    ];

    protected $listeners = [
        'province_idUpdated' => 'setProvinceId',
        'regency_idUpdated' => 'setRegencyId',
        'district_idUpdated' => 'setDistrictId',
        'village_idUpdated' => 'setVillageId',
        //'setLokasiGeo'=>'setLokasiGeo'
    ];

    public function setLokasiGeo($lokasi_geo)
    {
        //$this->consoleLog(print_r($lokasi_geo));
        $this->lokasi_longitude = $lokasi_geo[0];
        $this->lokasi_latitude = $lokasi_geo[1];
        //$this->dispatchBrowserEvent('lokasi_updated', ['geocodertext' => '']);
    }

    public function setProvinceId($id)
    {
        $this->province_id = $id;
    }

    public function setRegencyId($id)
    {
        $this->regency_id = $id;
    }

    public function setDistrictId($id)
    {
        $this->district_id = $id;
    }

    public function setVillageId($id)
    {
        $this->village_id = $id;
    }


    public function mount(){
        $this->rules = null;
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
        $this->rt_rw='11';
        $this->alamat = 'alamat';
    }

    public function render()
    {
        return view('livewire.wizard')->extends('layouts.auth');
    }
    
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName,$this->rules[$this->step]);
    // }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function stepCheck()
    {   
        $this->consoleLog('step : '.$this->step);
        if(0<$this->step&&$this->step<11){
            if($this->step==9){
                $this->consoleLog('file : ');
                //$this->consoleLog($this->file_denah_bangunan->temporaryUrl());
            }
            $this->consoleLog($this->rules);
            if($this->rules!=null&&count($this->rules[$this->step])>0)
                $validatedData = $this->validate($this->rules[$this->step]);
            $this->step++;
            if($this->step==6){
                $this->mapCheck();
            }
        }else if($this->step==0){
            $this->step=1;
        }
        $this->dispatchBrowserEvent('render');
    }

    public function stepCheckWMap($lokasi)
    {   
        $this->setLokasiGeo($lokasi);
        $this->consoleLog('stepwmap : lng, lat -> '.$this->lokasi_longitude.','.$this->lokasi_latitude);
        if(0<$this->step&&$this->step<11){
            if($this->rules!=null&&count($this->rules[$this->step])>0)
                $validatedData = $this->validate($this->rules[$this->step]);
            $this->step++;
        }else if($this->step==0){
            $this->step=1;
        }
        $this->dispatchBrowserEvent('render');
    }

  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back()
    {
        if($this->step==7){
            $this->mapCheck(true);
        }else if($this->step==6){
            $this->lokasi_longitude='';
            $this->lokasi_latitude='';
            $this->consoleLog('resetted lng, lat -> '.$this->lokasi_longitude.','.$this->lokasi_latitude);
        }
        if($this->step=='preview'){
            $this->step=10;  
        }else
            $this->step--;    
        $this->dispatchBrowserEvent('render');
    }

    protected function mapCheck(){
        $text='';
        $this->consoleLog('lng, lat -> '.$this->lokasi_longitude.','.$this->lokasi_latitude);
        if(!isset($this->lokasi_longitude)||empty($this->lokasi_longitude)){
            $this->village = Village::find($this->village_id['value'])->name;
            $this->district = District::find($this->district_id['value'])->name;
            $this->regency = Regency::find($this->regency_id['value'])->name;
            $this->province = Province::find($this->province_id['value'])->name;
            $text = $this->village.','.$this->district.','.$this->regency.','.$this->province;
        }
        $this->dispatchBrowserEvent('showMap', ['geocodertext' => $text]);
        //$this->emit('showMap',$text);
    }

    public function preview()
    {
        $this->consoleLog('step : '.$this->step);
        if($this->rules!=null&&count($this->rules[$this->step])>0)
            $validatedData = $this->validate($this->rules[$this->step]);
        $this->dispatchBrowserEvent('render',['step'=>'preview']);
        $this->step='preview';
    }

    private function buildData(){
        $arr = ['status_nppbkc'=>1];
        $str = '';
        //dd($this->province_id);
        foreach($this->rules as $rule){
            foreach($rule as $field=>$val){
                if (strpos($field, '_from') !== false||strpos($field, '_to') !== false||strpos($field, 'tanggal') !== false) {
                    $arr[$field] = Carbon::createFromFormat('d-m-Y', $this->{$field})->format('Y-m-d');
                }
                else if (strpos($field, 'file') === false&&strpos($field, 'village') === false) {
                    $arr[$field] = $this->{$field};
                    $str.=',\''.$field.'\'';
                }
            };
        }
        $arr['province_id']=$this->province_id['value'];
        $arr['regency_id']=$this->regency_id['value'];
        $arr['district_id']=$this->district_id['value'];
        $arr['village_id']=$this->village_id['value'];
        return $arr;
    }
    public function complete()
    {
        // public $file_denah_bangunan,$file_denah_lokasi,
        //$file_siup_mb,$file_itp_mb,$file_surat_kuasa;
        // public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,
        //$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;

        $data = $this->buildData();
        //dd($data);
        $nppbkc = Nppbkc::create($data);//test
        foreach(['file_denah_bangunan','file_denah_lokasi'] as $file){
            if($this->{$file}!=null){
                $filename = $this->{$file}->storeAs('nppbkc/1', $file.'.'.$this->{$file}->extension());
                $originalname = $this->{$file}->getClientOriginalName();
                $size = $this->{$file}->getSize();
                $nppbkc_file = new NppbkcFile([
                    'filename'=>$filename,
                    'original_name'=>$originalname,
                    'size'=>$size
                ]);
                $nppbkc->files()->save($nppbkc_file);
            }
        }
        
        $this->step='preview';
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
    public function clearForm()
    {
        $this->name = '';
        $this->amount = '';
        $this->description = '';
        $this->stock = '';
        $this->status = 1;
    }

}
