<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questao_Quiz;
use App\Models\Resposta_Quiz;
class AfirmacaoQuestaoQuiz extends Controller
{
    //
    public function afirmacoes($slug){
      $questao=  Questao_Quiz::where('slug',$slug)->first();
      Resposta_Quiz::where('id');

    }
}
