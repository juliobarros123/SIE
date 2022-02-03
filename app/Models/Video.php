<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
 {
    use HasFactory;
    protected $fillable = [

        'vc_descricao',
        'vc_video',
        'id_materia',
        'it_estado'

    ];
}
