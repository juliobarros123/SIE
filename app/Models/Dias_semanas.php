<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dias_semanas extends Model
{
    use HasFactory;
    protected $fillable = [
        'vc_dia' ,
        'it_estado'
    ];
}
