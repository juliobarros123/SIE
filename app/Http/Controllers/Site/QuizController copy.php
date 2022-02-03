<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Disciplina;
use App\Models\PerguntaQuiz;
use App\Models\Materia;
use App\Models\ClasseDisciplina;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class QuizController extends Controller
{
    public function listarDisciplnas()
    {
        $disciplinas=Disciplina::where('it_estado', 1)->get();
        $materias=DB::table('classe_disciplinas')
        ->join('materias', function ($join) {
        $join->on('classe_disciplinas.id', '=', 'materias.it_id_classeDisciplina');
        })->select('classe_disciplinas.id as id_c_d', 'materias.id as id_materia', 'materias.*', 'classe_disciplinas.disciplina_id')
      ->where('classe_disciplinas.it_estado', '=', 1) ->get();

        return  view('site.quizz.listarDisciplinas', compact('disciplinas'), compact("materias"));
    }

    public function escolherTemaDeQuiz($id_disciplina)
    {
   
        // $disciplina=Disciplina::find($id_disciplina);
        // $temas= Aula::where('id_disciplinas',$id_disciplina)->get();
      
        $disciplina=Disciplina::find($id_disciplina);
        $temas= Materia::where('it_id_classeDisciplina', $id_disciplina)->get();

        return  view('site.quizz.escolherTemaDeQuiz', compact('temas'), compact('disciplina'));
    }

    public function iniciarJogo(Request $s,$id_tema)
    {   
        session()->forget('pontuacao');
        $response['afirmacoes']=DB::table('pergunta_quizzes')
    ->join('materias', function ($join) {
        $join->on('materias.id', '=', 'pergunta_quizzes.id_materia');
    }) ->join('afirmacao_pergunta_quizzes', function ($join) {
        $join->on('afirmacao_pergunta_quizzes.id_pergunta_quizzes', '=', 'pergunta_quizzes.id');
    })->where('pergunta_quizzes.id_materia', '=', $id_tema)->where('pergunta_quizzes.it_estado', '=', 1)->limit('4')->get();

    
        $response['ttl_pergunta']=DB::table('pergunta_quizzes')
    ->join('materias', function ($join) {
        $join->on('materias.id', '=', 'pergunta_quizzes.id_materia');
    })->where('pergunta_quizzes.id_materia', '=', $id_tema)->count();
        if ($response['afirmacoes']->count()) {
            $pergunta=PerguntaQuiz::where('id_materia', $id_tema)->get();

            $s->session()->put('pos', [
                [
                    'pos'     => 1,
                ]
            ]
         
            );

           

            // dd(session('pos')['0']['pos']);
            return view('site.quizz.quiz', compact('pergunta'), $response);
        } else {
     
            return view('site.quizz.naoExisteQuiz');
        }
    }



    public function proximaPergunta(Request $s,$id_pergunta)
    {
        $response=null;
        $response['afirmacoes']=DB::table('pergunta_quizzes')
        ->join('materias', function ($join) {
            $join->on('materias.id', '=', 'pergunta_quizzes.id_materia');
        }) ->join('afirmacao_pergunta_quizzes', function ($join) {
            $join->on('afirmacao_pergunta_quizzes.id_pergunta_quizzes', '=', 'pergunta_quizzes.id');
        })->where('pergunta_quizzes.id', '=', $id_pergunta)->limit('4')->get();

        if (isset($response['afirmacoes'][0])) {
            $response['ttl_pergunta']=DB::table('pergunta_quizzes')
        ->join('materias', function ($join) {
            $join->on('materias.id', '=', 'pergunta_quizzes.id_materia');
        })->where('pergunta_quizzes.id_materia', '=',$response['afirmacoes'][0]->id_materia)->count();
        }
        // dd($_COOKIE['qt_reposta']);
    

        return view('site.quizz.quiz', $response);
    }

    public function proxima(Request $s, $id_pergunta){
        $pergunta=PerguntaQuiz::find($id_pergunta);
        $proximPerguntas=DB::table('pergunta_quizzes')
       ->where('pergunta_quizzes.id_materia', '=', $pergunta->id_materia)
       ->where('pergunta_quizzes.id', '>', $id_pergunta)
       ->limit('1')->get();
        $id_proximaPergunta=isset($proximPerguntas['0']->id)?$proximPerguntas['0']->id:'';

            return redirect()->route('quizz.proximaPergunta', ['id_proximaPergunta' => $id_proximaPergunta]);
        
    }

    public function verificarResposta(Request $s, $id_afirmacao, $id_pergunta_quizzes)
    {
        $estado=false;
        $reposta=DB::table('pergunta_quizzes')
        ->join('materias', function ($join) {
            $join->on('materias.id', '=', 'pergunta_quizzes.id_materia');
        })->join('afirmacao_pergunta_quizzes', function ($join) {
            $join->on('afirmacao_pergunta_quizzes.id_pergunta_quizzes', '=', 'pergunta_quizzes.id');
        })->join('resposta_pergunta_quizzes', function ($join) {
            $join->on('afirmacao_pergunta_quizzes.id', '=', 'resposta_pergunta_quizzes.id_afirmacao_pergunta_quizzes');
        })->where('pergunta_quizzes.id', '=', $id_pergunta_quizzes)->where('afirmacao_pergunta_quizzes.id', '=', $id_afirmacao)->get();
    
        $pergunta=PerguntaQuiz::find($id_pergunta_quizzes);


        if ($reposta->count()>0) {
            $estado=true;
            $this->createSessionPunctuation($s, $estado, $pergunta->descricao_perguntas);
        } else {
            $this->createSessionPunctuation($s, $estado, $pergunta->descricao_perguntas);
        }


        $proximPerguntas=DB::table('pergunta_quizzes')
       ->where('pergunta_quizzes.id_materia', '=', $pergunta->id_materia)
       ->where('pergunta_quizzes.id', '>', $id_pergunta_quizzes)
       ->limit('1')->get();
        $id_proximaPergunta=isset($proximPerguntas['0']->id)?$proximPerguntas['0']->id:'';



        $s->session()->put('pos_control', [
            [
                'pos_control'     => 0,
            ]
        ]
     
        );
        return view('site.quizz.decisao', compact('reposta'), ['estado'=>$estado,'id_proximaPergunta'=>$id_proximaPergunta]);
    }

    public function classificacao()
    {
       
        if (session()->has('pontuacao')) {
            $pontuacoes= session('pontuacao');
        }else {
          return redirect()->route('jogadores')->with('sempontuacao',1);
        }
        $classificao=  $this->filterClassificacao($pontuacoes);

        $response['tt_c']=count( $classificao->where('estado',true));
        $response['tt_r']=count( $classificao->where('estado',false));
   
        return view('site.quizz.classificacao',compact('classificao'),$response);
    }

    public function filterClassificacao($pontuacoes)
    {
        $classificao_limpa=array();

        foreach ($pontuacoes as $pontuacao) {
            if (isset($pontuacao['pergunta'])) {
              
                    array_push($classificao_limpa, [
                'estado' =>$pontuacao['estado'],
                'pergunta' =>$pontuacao['pergunta'],
                
            ]);
                
            } else {
                foreach ($pontuacao as $pt) {
                    if (isset($pt['pergunta'])) {

                    

                        
                            array_push($classificao_limpa, [
                            'estado' =>$pt['estado'],
                            'pergunta' =>$pt['pergunta'],
                            
                        ]);
                        }
                    } 
                
            }
        }
       return $this->filtrar_pergunta($classificao_limpa);
    }

   
    public function filtrar_pergunta($classificao_limpa)
    {
        $pergunta1=collect();
        foreach($classificao_limpa as $classificao){
            $pergunta1->push($classificao);
            $pergunta1->all();
        }
        $unique = $pergunta1->unique();
        $unique->values()->all();
        return $unique;
        // dd($pergunta1->unique());
        // dd($classificao_limpa);
        // $perguntas=array();
        // $perguntas_res=array();

        // foreach ($classificao_limpa as $cl) {
        //     if (count($perguntas)) {
        //         foreach ($perguntas as $pergunta) {
        //             if ($pergunta['pergunta']!=$cl['pergunta']) {
        //                 array_push($perguntas_res, [
        //                     'estado' =>$cl['estado'],
        //                     'pergunta' =>$cl['pergunta'],
                            
        //                 ]);
        //                 array_push($perguntas, [
        //                     'pergunta' =>$cl['pergunta'],
                            
        //                 ]);
        //             } else {
        //                 array_push($perguntas_res, [
        //             'estado' =>$cl['estado'],
        //             'pergunta' =>$cl['pergunta'],
                    
        //         ]);
        //                 array_push($perguntas, [
                    
        //             'pergunta' =>$cl['pergunta'],
                    
        //         ]);
        //             }
        //         }
        //     }
        // }
        // dd($perguntas_res,$perguntas);
    }
    
     
    

    public function createSessionPunctuation($s, $estado, $pergunta)
    {
        if (session()->has('pontuacao')) {
            $pontuacao = session('pontuacao');
            
            $array_pergunta=array(
                ['estado' =>$estado,
                'pergunta' =>$pergunta,
                
            ]
             );
          
            array_push($pontuacao, $array_pergunta);

      
            session()->forget('pontuacao');
            $s->session()->put(
                'pontuacao',
                $pontuacao
            );
        } else {
            $s->session()->put(
                'pontuacao',
                [
            ['estado' =>$estado,
            'pergunta' =>$pergunta,
            
        ]
        ]
            );
        }
    }

    public function sessionHas($pergunta)
    {
        if (session()->has('pontuacao')) {
        } else {
            return false;
        }
    }
}
