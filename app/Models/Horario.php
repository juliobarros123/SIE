<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
 {
    use HasFactory;
    protected $fillable = [
        'it_id_classedisciplina',
        'vc_hora_inicio',
        'vc_hora_fim',
        'it_id_dias',
        'it_id_anoslectivos',
        'it_estado'
    ];
}
