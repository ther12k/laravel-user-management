<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NppbkcFile extends Model
{
    use HasFactory;
    protected $fillable = ['filename','original_name','size'];
}
