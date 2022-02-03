<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model {
    use HasFactory;
    protected $fillable = [
        'vc_disciplina' ,
        'it_estado',
        'vc_imagem'
    ];
}
