<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
  
    public function user() 
    { 
        return $this->morphOne('App\Models\User', 'profile');
    }
}
