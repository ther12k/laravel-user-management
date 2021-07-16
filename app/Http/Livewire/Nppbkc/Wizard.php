<?php

namespace App\Http\Livewire\Nppbkc;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use App\Models\Nppbkc;
use App\Models\NppbkcFile;


use Carbon\Carbon;
use App\Notifications\NppbkcAddedNotification;
use PDF,Auth,Hash,QrCode;

class Wizard extends Component
{
    use WithFileUploads;

    private $hashKey = "nppbkc-file";

    public $nppbkc,$nppbkc_id;
    public $step = 0, $status_nppbkc = 1;
    public $status_pemohon='sendiri', $nama_pemilik, $alamat_pemilik,$email_pemilik,$telp_pemilik,$npwp_pemilik='xx.xxx.xxx.x-xxx.xxx';
    public $jenis_usaha_bkc,$jenis_bkc; 
    public $nama_usaha, $alamat_usaha,$email_usaha,$telp_usaha,$npwp_usaha='xx.xxx.xxx.x-xxx.xxx', $no_permohonan;
    public $jenis_lokasi,$lokasi,$kegunaan; 
    public $province,$regency,$district,$village;
    public $province_id,$regency_id,$district_id,$village_id; 
    public $rt_rw,$alamat,$lokasi_geo,$lokasi_latitude,$lokasi_longitude;
    public $no_siup_mb,$masa_berlaku_siup_mb_from,$masa_berlaku_siup_mb_to,$masa_berlaku_itp_mb_from,$masa_berlaku_itp_mb_to,$no_itp_mb,$no_izin_nib,$tanggal_nib;
    public $tanggal_kesiapan_cek_lokasi;
    public $file_denah_bangunan,$file_denah_lokasi,$file_siup_mb,$file_itp_mb,$file_surat_kuasa;
    public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
    public $successMessage = '';
    public $created_at,$surat_permohonan_lokasi_url;

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
            'no_permohonan'=>'nullable|unique:nppbkcs,id',
            'nama_usaha' => 'required|min:4',
            'alamat_usaha' => 'required',
            'telp_usaha' => 'required',
            //xx.xxx.xxx.x-xxx.xxx
            //'npwp_usaha' => 'required|regex:/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}.[0-9]-[0-9]{3}\.[0-9]{3}$/',
            'email_usaha' => 'required|email:filter',
        ],
        [
            'jenis_lokasi' => 'required',
            'kegunaan' => 'required'
        ],
        [
            'village_id' => 'required',
        ],
        [
            'rt_rw' =>'required',
            'alamat' =>'required',
            'lokasi_latitude' =>'required',
            'lokasi_longitude' =>'required'
        ],
        [
            'no_siup_mb'=>'required',
            // 'masa_berlaku_siup_mb_from'=>'required',
            'masa_berlaku_siup_mb_to'=>'required|date|after_or_equal:masa_berlaku_siup_mb_from',
            'no_itp_mb'=>'required',
            // 'masa_berlaku_itp_mb_from'=>'required',
            'masa_berlaku_itp_mb_to'=>'required|date|after_or_equal:masa_berlaku_itp_mb_from',
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
            'file_nib'=>'required'
        ],
        [
            'file_npwp_pemilik'=>'required',
            'file_ktp_pemilik'=>'required',
            'file_surat_pernyataan'=>'required',
            // 'file_data_registrasi'=>'required'
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

        'no_permohonan.unique' => 'No Permohonan sudah pernah dipakai, silahkan ganti.',
        'nama_usaha.required' => 'Nama tidak boleh kosong.',
        'alamat_usaha.required' => 'Alamat tidak boleh kosong.',
        'telp_usaha.required' => 'No Telp tidak boleh kosong.',
        'alamat_usaha.required' => 'Alamat tidak boleh kosong.',
        'npwp_usaha.required' => 'NPWP tidak boleh kosong.',
        'npwp_usaha.regex' => 'NPWP tidak valid.',
        'email_usaha.required' => 'email tidak boleh kosong.',
        'email_usaha.email' => 'Format email salah.',
        'lokasi.required' => 'Lokasi tidak boleh kosong.',
        'masa_berlaku_siup_mb_from.required'=>'Tanggal belum dipilih',
        'masa_berlaku_siup_mb_to.required'=>'Tanggal belum pilih',
        'masa_berlaku_siup_mb_to.after_or_equal'=>'Tanggal akhir harus lebih besar/sama dari tanggal awal',


        'masa_berlaku_itp_mb_from.required'=>'Tanggal belum dipilih',
        'masa_berlaku_itp_mb_to.required'=>'Tanggal belum pilih',
        'masa_berlaku_itp_mb_to.after_or_equal'=>'Tanggal akhir harus lebih besar/sama dari tanggal awal',
        'no_siup_mb.required' => 'Nomor Izin SIUP-MB / SKMB harus diisi.',
        'no_itp_mb.required' => 'Nomor Izin ITP-MB harus diisi.',
        'no_izin_nib.required' =>'No Izin NIB harus diisi.',
        'tanggal_nib.required' =>'Tanggal NIB harus diisi.',

        'tanggal_kesiapan_cek_lokasi.required' => 'Tanggal kesiapan cek lokasi harus diisi.',

        'jenis_lokasi.required' => 'Pilih jenis lokasi.',
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

    public function updated($field){
        if(($field=='masa_berlaku_siup_mb_from'||$field=='masa_berlaku_siup_mb_to')
            &&!empty($this->masa_berlaku_siup_mb_from)&&!empty($this->masa_berlaku_siup_mb_to)){
            $this->validateOnly('masa_berlaku_siup_mb_to',$this->rules[$this->step]);
        }
        else if(($field=='masa_berlaku_itp_mb_from'||$field=='masa_berlaku_itp_mb_to')
            &&!empty($this->masa_berlaku_itp_mb_from)&&!empty($this->masa_berlaku_itp_mb_to
        )){
            $this->validateOnly('masa_berlaku_itp_mb_to',$this->rules[$this->step]);
        }else{
            $this->validateOnly($field,$this->rules[$this->step]);
            //dd($this->masa_berlaku_siup_mb_from);
            if($field=='masa_berlaku_siup_mb_to'){
                $this->validateOnly('masa_berlaku_siup_mb_from',['masa_berlaku_siup_mb_from'=>'required']);
            }
            if($field=='masa_berlaku_itp_mb_from'){
                $this->validateOnly('masa_berlaku_itp_mb_from',['masa_berlaku_itp_mb_from'=>'required']);
            }
        }
    }

    public function mount($id=null){
        if(isset($id)){
            $this->nppbkc_id = $id;
            $nppbkc = Nppbkc::findOrFail($id);
            if($nppbkc->created_by!=Auth::user()->id){
                abort(401);
            }
            // foreach($nppbkc->toArray() as $key=>$val){
            //     $this->{$key} = $val;
            // }
            foreach($this->rules as $rule){
                foreach($rule as $field=>$val){
                    $this->{$field} = $nppbkc->{$field};

                    if (strpos($field, 'masa') !== false||strpos($field, 'tanggal') !== false) {
                        $this->{$field} = Carbon::parse($nppbkc->{$field})->format('d-m-Y');
                    }
                }
            }
            $this->masa_berlaku_siup_mb_from = Carbon::parse($nppbkc->masa_berlaku_siup_mb_from)->format('d-m-Y');
            $this->masa_berlaku_itp_mb_from = Carbon::parse($nppbkc->masa_berlaku_itp_mb_from)->format('d-m-Y');

            $village =  $nppbkc->village;
            $this->village_id = ['name'=>'village_id','value'=>$village->id];
            $this->village = $village->name;

            $district =  $village->district;
            $this->district_id = ['name'=>'district_id','value'=>$district->id];
            $this->district = $district->name;

            $regency =  $district->regency;
            $this->regency_id = ['name'=>'regency_id','value'=>$regency->id];
            $this->regency = $regency->name;

            $province =  $regency->province;
            $this->province_id = ['name'=>'province_id','value'=>$province->id];
            $this->province = $province->name;

            $this->no_permohonan = $nppbkc->no_permohonan;
            // $this->no_permohonan_lokasi = $nppbkc->no_permohonan_lokasi;
            // dd($this);
            // $this->rules = null;
            $this->nppbkc = $nppbkc;
        }else{

            //test
            $profile = Auth::user()->profile;
            $this->nama_pemilik=$profile->nama;
            $this->alamat_pemilik=$profile->alamat;
            $this->telp_pemilik=$profile->no_telp;
            //$this->npwp_pemilik='11.111.111.1-111.111';
            $this->email_pemilik=Auth::user()->email;

            // $this->nama_usaha='nama usaha';
            // $this->alamat_usaha='alamat usaha';
            // $this->telp_usaha='12345';
            // $this->npwp_usaha='11.111.111.1-111.111';
            // $this->email_usaha='rizkyz@gmail.com';
            // $this->rt_rw='11';
            // $this->alamat = 'alamat';
            // $this->created_at =  date('c');
        };
    }

    public function render()
    {
        //dd($this->status_pemohon);
        return view('livewire.nppbkc.wizard')
                    ->extends('layouts.app');
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
        // dd($this);
        if($this->nppbkc_id!=null){
            $this->rules[9]=[];
            $this->rules[10]=[];
            $this->rules[3]['no_permohonan']='nullable|unique:nppbkcs,no_permohonan,'.$this->nppbkc_id;
        }
        // dd($this->rules);
        $this->consoleLog('step : '.$this->step);
        if(0<$this->step&&$this->step<11){
            if($this->rules!=null&&count($this->rules[$this->step])>0){
                $rules = $this->rules[$this->step];
                if($this->step==7){
                    $rules = array_merge($this->rules[$this->step],[
                        'masa_berlaku_siup_mb_from'=>'required',
                        'masa_berlaku_itp_mb_from'=>'required']);
                }
                $validatedData = $this->validate($rules);
            }
            if($this->step==10){
                $this->step = 'preview';
            }else{
                $this->step++;
            }
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
            //dd($this->rules[$this->step]);
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
        // $this->no_permohonan='';
        if($this->step==7){
            $this->mapCheck(true);
        }else if($this->step==6){
            $this->lokasi_longitude='';
            $this->lokasi_latitude='';
            $this->consoleLog('resetted lng, lat -> '.$this->lokasi_longitude.','.$this->lokasi_latitude);
        }
        if($this->step=='preview'){
            $this->step=10;  
        }else if($this->step=='complete'){
            $this->step='preview'; 
        }else{
            $this->step--; 
        }
         
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
        if($this->nppbkc_id!=null){
            $this->rules[9]=[];
            $this->rules[10]=[];
        }
        if($this->npwp_usaha=='xx.xxx.xxx.x-xxx.xxx'){
            $this->npwp_usaha='';
        }
        $this->consoleLog('step : '.$this->step);
        if($this->rules!=null&&count($this->rules[$this->step])>0)
            $validatedData = $this->validate($this->rules[$this->step]);
        $this->dispatchBrowserEvent('render',['step'=>'preview']);
        $this->step='preview';
    }



    private function generate_permohonan_cek_lokasi($nppbkc){
        $pdfHTML = view('pdf.permohonan_lokasi')->render();
        $formats=[];
        $replaces=[];
        $dataPdf = $nppbkc->toArray();
        $dataPdf['regency'] = $nppbkc->regency->name;
        $createdBy = $nppbkc->createdBy()->first()->profile;
        $dataPdf['nama_user'] = $createdBy->nama;
        $dataPdf['pekerjaan_user'] = $createdBy->pekerjaan;
        $dataPdf['email_user'] = $createdBy->email;
        $dataPdf['alamat_user'] = $createdBy->alamat;
        $dataPdf['telp_user'] = $createdBy->no_telp;
        $dataPdf['email_user'] = $nppbkc->createdBy()->first()->email;
        foreach($dataPdf as $key=>$val){
            if($key=='no_permohonan') continue;
            $formats[]='['.strtoupper($key).']';
            if($key=='nama_usaha')
                $val=strtoupper($val);
            if(strpos($key,'masa_berlaku')!==false||
                strpos($key,'tanggal')!==false){
                    $val=Carbon::parse($val)->isoFormat('D MMMM Y');
                }
            $val = '<strong>'.$val.'</strong>';
            $replaces[]=$val;
        }
        $formats[]='[NO_PERMOHONAN]';
        $replaces[]='<strong>'.$nppbkc->no_permohonan_lokasi.'</strong>';
        
        $formats[]='[TANGGAL_PENGAJUAN]';
        $replaces[]='<strong>'.$nppbkc->created_at->isoFormat('D MMMM Y').'</strong>';

        //replace all
        $pdfHTML = str_replace($formats,$replaces,$pdfHTML);
        
        $pdf_filename = date('Ymd').'/nppbkc/'.$nppbkc->id.'/'.$nppbkc->id.'_surat_permohonan_cek_lokasi.pdf';
        // $exists = Storage::disk('local')->exists($pdf_filename);
        // if($exists){
        //     Storage::delete($pdf_filename);
        // }
        $hash = md5($this->hashKey.'-cek-lokasi'.$nppbkc->id);
        $this->surat_permohonan_lokasi_url = url('/nppbkc/download-file/'.$hash);
        $qrImage= base64_encode(
            QrCode::format('png')
            ->size(80)
            ->generate($this->surat_permohonan_lokasi_url)
        );
        $qrImage = '<img src="data:image/png;base64,'.$qrImage.'" style="margin-top:2px;margin-bottom:2px">';
        $pdfHTML = str_replace('[QRCODE]',$qrImage,$pdfHTML);
        $pdf = PDF::loadHTML($pdfHTML)->setPaper('a4', 'potrait');
        Storage::put($pdf_filename, $pdf->output());     
        $file = $nppbkc->files()->save(
                            new NppbkcFile([
                                'key'=>$hash,
                                'name'=>'surat_permohonan_lokasi',
                                'title'=>'Surat Permohonan Pengecekan Lokasi',
                                'filename'=>$pdf_filename,
                                'original_filename'=>'',
                                'size'=>strlen($pdfHTML),
                                'ext'=>'.pdf',
                                'is_annotation'=>2
                            ])
                        ); 
        return $pdf_filename;
    }

    private function buildData(){
        $arr = [];
        $str = '';
        //dd($this->province_id);
        foreach($this->rules as $rule){
            foreach($rule as $field=>$val){
                if(!isset($this->{$field})||$this->{$field}==null) continue;

                if (strpos($field, '_from') !== false||strpos($field, '_to') !== false||strpos($field, 'tanggal') !== false) {
                    $arr[$field] = Carbon::createFromFormat('d-m-Y', trim($this->{$field}))
                                        ->format('Y-m-d');
                }
                else if (strpos($field, 'file') === false&&strpos($field, 'village') === false) {
                    $arr[$field] = trim($this->{$field});
                    $str.=',\''.$field.'\'';
                }
            };
        }
        
        $arr['province_id']=$this->province_id['value'];
        $arr['regency_id']=$this->regency_id['value'];
        $arr['district_id']=$this->district_id['value'];
        $arr['village_id']=$this->village_id['value'];
        $arr['no_permohonan_lokasi']=trim($this->no_permohonan);
        $arr['status_nppbkc']=1;
        $arr['masa_berlaku_siup_mb_from'] = Carbon::createFromFormat('d-m-Y', trim($this->masa_berlaku_siup_mb_from))->format('Y-m-d');
        $arr['masa_berlaku_itp_mb_from'] = Carbon::createFromFormat('d-m-Y', trim($this->masa_berlaku_itp_mb_from))->format('Y-m-d');
        
        return $arr;
    }
    
    public function complete()
    {
        // public $file_denah_bangunan,$file_denah_lokasi,
        //$file_siup_mb,$file_itp_mb,$file_surat_kuasa;
        // public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,
        //$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;
        try {
            $data = $this->buildData();
            // dd($this->no_permohonan);
            if($this->no_permohonan==null||empty($this->no_permohonan)){
                //generate auto number
                $array_bln  = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
                $bln = $array_bln[date('n')];
                $no = Nppbkc::where('nama_usaha',$this->nama_usaha)->orderByDesc('id')->first();
                if($no!=null){
                    $no = (int)explode('/', $no->no_permohonan)[0];
                }else{
                    $no=0;
                }
                $this->no_permohonan = $data['no_permohonan'] = $data['no_permohonan_lokasi'] = str_pad($no+1,6,"0",STR_PAD_LEFT).'/'.
                    str_replace(' ','_',strtoupper($data['nama_usaha'])).'/'.$bln.'/'.date('Y');
                // while(Nppck::where('no_permohonan','=',$nppbkc->no_permohonan)->count()>0){
                //     $nppbkc->no_permohonan = str_pad($no++,6,"0",STR_PAD_LEFT).'/'.
                //     str_replace(' ','_',strtoupper($data['nama_usaha'])).'/'.$bln.'/'.date('Y');
                // }
            }else{
                $data['no_permohonan_lokasi'] = $this->no_permohonan;
            }
            // dd($data);
            if($this->nppbkc_id==null)
                $nppbkc = Nppbkc::create($data);
            else{
                $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
                // dd($nppbkc);
                $nppbkc->update($data);
            }
            foreach(nppbkc_file_captions() as $name=>$title){
                if($this->{$name}!=null){
                    $filename = $this->{$name}->storeAs('nppbkc/'.$nppbkc->id, $name.'.'.$this->{$name}->extension());
                    $originalname = $this->{$name}->getClientOriginalName();
                    $size = $this->{$name}->getSize();
                    $hash = md5($this->hashKey.'-'.$name.$nppbkc->id);
                    $nppbkc_file = new NppbkcFile([
                        'key'=>$hash,
                        'name'=>$name,
                        'title'=>$title,
                        'filename'=>$filename,
                        'original_filename'=>$originalname,
                        'size'=>$size,
                        'ext'=>$this->{$name}->extension()
                    ]);
                    $nppbkc->files()->save($nppbkc_file);
                }
            }

            if($this->nppbkc_id==null){
                //file registrasi
                $user = Auth::user();
                $userRegistrationFile = $user->files()->OfName('file_registrasi_pengusaha_bkc')->first();
                $file = $nppbkc->files()->save(
                    new NppbkcFile([
                        'key'=>'user_'.$hash,
                        'name'=>'registrasi_pengusaha_bkc',
                        'title'=>'Data Registrasi Pengusaha BKC',
                        'filename'=>$userRegistrationFile->filename,
                        'original_filename'=>$userRegistrationFile->original_filename,
                        'size'=>$userRegistrationFile->size,
                        'ext'=>$userRegistrationFile->ext
                    ])
                ); 
            }

            $nppbkc->save();
            $this->created_at = $nppbkc->created_at;
            $pdf_filename = $this->generate_permohonan_cek_lokasi($nppbkc);
            $url = url($pdf_filename);
            try{
                $nppbkc->notify(new NppbkcAddedNotification([
                    'text' => "Permohonan NPPBKC baru ".$nppbkc->id,
                    'content' =>"*Permohonan baru, no ".$nppbkc->no_permohonan_lokasi."* [Lihat](http://www.google.com)",
                    'filename' =>$pdf_filename,
                    'url' =>$pdf_filename
                ]));
            }catch (\Exception $e) {
                $this->consoleLog($e);
            }
            $this->step='complete';
        }catch (\Exception $e) {
            dd($e);
            $this->step='preview';
        }
    }

}
