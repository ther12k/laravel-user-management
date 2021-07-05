<?php

namespace App\Models;

use App\Models\Nppbkc;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class NppbkcAnnotation extends Model
{
    use HasFactory,Blameable;
    protected $fillable = ['status_nppbkc','catatan_petugas'];
    public function scopeOfStatus($query,$status_nppbkc)
    {
        return $query->where('status_nppbkc', $status_nppbkc);
    }
    public function nppbkc()
    {
        return $this->belongsTo(Nppbkc::class);
    }
}
