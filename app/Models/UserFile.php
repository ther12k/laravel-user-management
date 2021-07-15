<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use DigitalCloud\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Model;

class UserFile extends Model
{
    use HasFactory,Blameable;
    protected $fillable = ['user_id','key','name','title','filename','original_filename','size','ext'];
    public function scopeOfName($query,$name)
    {
        return $query->where('name', $name);
    }
    public function scopeOfKey($query,$key)
    {
        return $query->where('key', $key);
    }
}
