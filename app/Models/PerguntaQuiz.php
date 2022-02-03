<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerguntaQuiz extends Model
{
    use HasFactory;
    protected $fillable=[
        'descricao_perguntas',
        'time',
        'id_materia',
        'pos',
        'it_estado'
    ];
}
