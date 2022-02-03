<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hora extends Model
{
    use HasFactory;
     protected $fillable = [
        'vc_hora_inicio' ,
        'vc_hora_fim',
        'it_estado'
    ];
}
