<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoYoutube extends Model
{
    use HasFactory;
    protected $fillable = [

        'vc_descricao',
        'vc_link',
        'id_materia',
        'it_estado'

    ];
}
