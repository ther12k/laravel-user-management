<?php

namespace App\Http\Livewire\Nppbkc;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Nppbkc;
use Auth;

class View extends Component
{
    use WithFileUploads;
    public $nppbkc_id;
    public $data;
    public $isEdited=false;
    // public $nama_pemilik, $alamat_pemilik,$email_pemilik,$telp_pemilik,$npwp_pemilik='xx.xxx.xxx.x-xxx.xxx';
    // public $jenis_usaha_bkc,$jenis_bkc; 
    // public $nama_usaha, $alamat_usaha,$email_usaha,$telp_usaha,$npwp_usaha='xx.xxx.xxx.x-xxx.xxx', $no_permohonan;
    // public $jenis_lokasi,$lokasi,$kegunaan; 
    // public $province,$regency,$district,$village;
    // public $province_id,$regency_id,$district_id,$village_id; 
    // public $rt_rw,$alamat,$lokasi_geo,$lokasi_latitude,$lokasi_longitude;
    // public $no_siup_mb,$masa_berlaku_siup_mb_from,$masa_berlaku_siup_mb_to,$masa_berlaku_itp_mb_from,$masa_berlaku_itp_mb_to,$no_itp_mb,$no_izin_nib,$tanggal_nib;
    // public $tanggal_kesiapan_cek_lokasi;
    // public $file_denah_bangunan,$file_denah_lokasi,$file_siup_mb,$file_itp_mb,$file_surat_kuasa;
    // public $file_nib,$file_npwp_pemilik,$file_npwp_usaha,$file_ktp_pemilik,$file_surat_pernyataan,$file_data_registrasi;


    public $petugas_files=[
        'file_surat_tugas'=>'Surat tugas periksa lokasi',
        'file_ba_periksa'=>'Berita acara periksa lokasi',
        'file_ba_wawancara'=>'Berita acara wawancara'
    ];
    private $shouldRender = true;

    protected $listeners = ['valueEdited'];

    public function editData(){
        $this->isEdited = true;
    }

    public function cancelEdit(){
        $this->isEdited = false;
    }
    
    public function valueEdited($field,$value)
    {
        $this->data[$field] = $value;
        $this->shouldRender = false;
        //$nppbkc->save();
    }

    public function saveEdit(){
        dd(session('nppbkc'));
    }
    
    public function mount($id)
    {
        $this->nppbkc_id = $id;
    }
    
    public function render()
    {
        if(!$this->shouldRender){
            $this->shouldRender = true;
            return '';
        }
        $nppbkc = Nppbkc::findOrFail($this->nppbkc_id);
        //if($nppbkc==null) abort(404);
        if(!\Gate::allows('viewAllNppbkc')){
            if($nppbkc->created_by!=Auth::user()->id){
                abort(401);
            }
        }
        $lampiran = [];
        foreach($nppbkc->nppbkcFiles->all() as $file){
            if(!array_key_exists($file->filename,$lampiran)){
                $lampiran[$file->filename] = $file;
            }
        }
        $this->data = array_merge($nppbkc->toArray(),
            [
                'files'=>$lampiran,
                'file_surat_permohonan_lokasi'=>$nppbkc->files()->OfName('surat_permohonan_lokasi')->orderByDesc('id')->first(),
                'file_surat_permohonan_nppbkc'=>$nppbkc->files()->OfName('surat_permohonan_nppbkc')->orderByDesc('id')->first(),
                'petugas_files'=>$nppbkc->annotationFiles->all()
            ]
        );
        $this->data['village'] = $nppbkc->village->name;
        $this->data['district'] = $nppbkc->village->district->name;
        $this->data['regency'] = $nppbkc->village->district->regency->name;
        $this->data['province'] = $nppbkc->village->district->regency->province->name;
        session(['nppbkc'=>$this->data]);
        
        return view('livewire.nppbkc.view', $this->data)
            ->extends('layouts.app');
    }


    public function openmap()
    {
        $this->nppbkc_id = $id;
    }

    public function initDatePicker(){

        $this->dispatchBrowserEvent('initDatepicker');
        $this->shouldRender = false;
    }

    public function updateStatus(){
        $this->shouldRender = false;
        $this->emit("openModal", "nppbkc.modal",["id"=>$this->nppbkc_id]);
    }
}
