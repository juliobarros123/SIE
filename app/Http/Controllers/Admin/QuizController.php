<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerguntaQuiz;
use App\Models\AfirmacaoPerguntaQuiz;
use Illuminate\Support\Facades\DB;
use App\Models\RespostaPerguntaQuiz;

class QuizController extends Controller
{
    //

    public function listar(){
        // $quizzes=DB::table('pergunta_quizzes')
        // ->join('materias','materias.id', '=', 'pergunta_quizzes.id_materia')
        // ->join('classe_disciplinas','classe_disciplinas.id', '=', 'materias.it_id_classeDisciplina')
        // ->join('disciplinas','disciplinas.id', '=', 'classe_disciplinas.disciplina_id')
        // ->select('pergunta_quizzes.id as id_pergunta','materias.vc_materia','disciplinas.vc_disciplina')
        // ->get();

        $quizzes=DB::table('materias')
        ->join('classe_disciplinas','classe_disciplinas.id', '=', 'materias.it_id_classeDisciplina')
        ->join('disciplinas','disciplinas.id', '=', 'classe_disciplinas.disciplina_id')
        ->select('materias.id as id_materia','materias.vc_materia','disciplinas.vc_disciplina')
        ->where('materias.it_estado', '=', 1)
        ->get();
       
         return view('admin.quiz.listar',compact('quizzes'));
    }

    public function perguntas_listar($id_tema){

    $perguntas=DB::table('pergunta_quizzes')
    ->join('materias','materias.id', '=', 'pergunta_quizzes.id_materia')
    ->join('afirmacao_pergunta_quizzes','afirmacao_pergunta_quizzes.id_pergunta_quizzes', '=', 'pergunta_quizzes.id')
    ->join('resposta_pergunta_quizzes','resposta_pergunta_quizzes.id_afirmacao_pergunta_quizzes', '=', 'afirmacao_pergunta_quizzes.id')
    ->select('pergunta_quizzes.descricao_perguntas','pergunta_quizzes.id as id_pergunta','materias.vc_materia','afirmacao_pergunta_quizzes.descricao_respostas')
    ->where('pergunta_quizzes.id_materia', '=', $id_tema)
    ->where('pergunta_quizzes.it_estado', '=', 1)->get();


    return view('admin.quiz.perguntas',compact('perguntas'));
    }


    public function perguntas_editar($id_pergunta){

      $response['pergunta']=  PerguntaQuiz::find($id_pergunta);
      $response['afirmacoes']= AfirmacaoPerguntaQuiz::where('id_pergunta_quizzes', $id_pergunta)->get();
   
       $response['resposta']=$this->resposta($response['afirmacoes']);
      
       return view('admin.quiz.editar_pergunta',$response);
        
    }

    public function resposta($afirmacoes){
        foreach($afirmacoes as $afirmacao){
         $resposta=   RespostaPerguntaQuiz::where('id_afirmacao_pergunta_quizzes', $afirmacao->id)->count();
   
         if($resposta)
         return  RespostaPerguntaQuiz::where('id_afirmacao_pergunta_quizzes', $afirmacao->id)->first();
        }
    }

   
}
