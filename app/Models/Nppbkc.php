<?php

namespace App\Models;

use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

class Nppbkc extends Model
{
    use HasFactory,Blameable,LogsActivity;
    
    protected $fillable = [
        'status_pemohon','nama_pemilik','alamat_pemilik','telp_pemilik','npwp_pemilik','email_pemilik',
        'jenis_usaha_bkc','jenis_bkc','nama_usaha','alamat_usaha','telp_usaha','npwp_usaha','email_usaha',
        'jenis_lokasi','lokasi','kegunaan','village_id','rt_rw','alamat',
        'province_id','regency_id','district_id','village_id',
        'no_siup_mb','masa_berlaku_siup_mb_from','masa_berlaku_siup_mb_to','no_itp_mb',
        'masa_berlaku_itp_mb_from','masa_berlaku_itp_mb_to','no_izin_nib',
        'tanggal_nib','tanggal_kesiapan_cek_lokasi'
    ];

    //protected static $recordEvents = ['created','updated','deleted'];
    protected static $logAttributes = ['created_by', 'updated_by','status_nppbkc'];
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;
    protected static $logName = 'nppbkc';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "NPPBKC has been {$eventName}";
    }

    public function files()
    {
        return $this->hasMany(NppbkcFile::class);
    }
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function village()
    {
        return $this->belongsTo(Village::class);
    }
}
