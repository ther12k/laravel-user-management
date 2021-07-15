<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class NppbkcFile extends Model
{
    use HasFactory,Blameable;
    protected $fillable = ['key','name','title','filename','original_filename','size','ext','is_annotation'];
    public function scopeOfName($query,$name)
    {
        return $query->where('name', $name);
    }
    public function scopeOfKey($query,$key)
    {
        return $query->where('key', $key);
    }
}
