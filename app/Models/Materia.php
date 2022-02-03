<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
 {
    use HasFactory;
    protected $fillable = ['vc_materia', 'id_horarios', 'it_estado', 'it_id_classeDisciplina','dt_data_vizualizar','it_id_unidadeMateria'];
}
