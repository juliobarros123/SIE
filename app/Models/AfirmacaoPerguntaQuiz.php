<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfirmacaoPerguntaQuiz extends Model
{
    use HasFactory;
    protected $fillable=[
        'descricao_respostas',
        'id_pergunta_quizzes'
    ];

}
