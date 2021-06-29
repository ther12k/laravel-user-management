<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DigitalCloud\Blameable\Traits\Blameable;

class NppbkcFile extends Model
{
    use HasFactory,Blameable;
    protected $fillable = ['name','filename','original_filename','size'];
}
