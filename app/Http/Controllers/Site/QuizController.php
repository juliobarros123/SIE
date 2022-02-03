<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClasseDisciplina;
use App\Models\Nivel_Quiz;
use App\Models\Questao_Quiz;
use App\Models\Resposta_Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    //

    private $questao;
    public function __construct(Questao_Quiz $questao)
    {
        $this->questao = $questao;
    }
    public function niveis()
    {

    }
    public function disciplinas(Request $request, ClasseDisciplina $data)
    {
        $request->session()->forget('questoes');
        $request->session()->forget('pontos');
        // $request->session()->put('id_classe_disciplina', $id_c1_disciplina);
        $response['niveis'] = Nivel_Quiz::all();
        $response['classes'] = Classe::where([['it_estado', 1]])->orderBy('vc_classe', 'asc')->get();
        //    dd($data->classes_disciplinas()->get());
        $response['disciplinas'] = $data->classes_disciplinas()->get();
        return view('site.quiz.disciplina.index', $response);
    }
    public function nivel(Request $request, $id_c1_disciplina)
    {
        $request->session()->put('id_classe_disciplina', $id_c1_disciplina);
        $response['niveis'] = Nivel_Quiz::all();
        return view('site.quiz.nivel.index', $response);
    }
    public function nivel_guardar(Request $request, $slug,$id_c_d)
    {
       
        $request->session()->put('id_classe_disciplina', $id_c_d);

        $request->session()->put('slug_nivel', $slug);
        $questoes = $this->questao->dados()
        ->where('classe_disciplinas.id', $id_c_d)->count();
       
        if(!$questoes){
            return view('site.quiz.questao.nenhuma');
        }
        return redirect()->route('desafios.quizzes.questao');
    }

    public function questao(Request $request)
    {

        $idCD = $request->session()->get('id_classe_disciplina');
        $slug_nivel = $request->session()->get('slug_nivel');

        if (!$request->session()->has('questoes')) {
            $questoes = $this->questao->dados()
                ->where('classe_disciplinas.id', $idCD)
                ->where('nivel__quizzes.slug', $slug_nivel)
                ->inRandomOrder()
                ->select('questao__quizzes.id as id_questao', 'questao__quizzes.questao', 'questao__quizzes.slug', 'questao__quizzes.time','categoria__quizzes.categoria')
            ;
            $request->session()->put('questoes', $questoes->get());
            $request->session()->put('ttl_pergunta', $questoes->count());
        } else {
            $response['questoes'] = $request->session()->get('questoes');
            $response['questao'] = $response['questoes']->first();
            $key = $request->session()->get('questoes')->keys()->first();
            $novas_questoes = $request->session()->get('questoes')->forget($key);
        }
        // dd($request->session()->get('questoes')->isNotEmpty(),$request->session()->has('pontos'));

        // dd($request->session()->get('questoes'));
        if (!$request->session()->get('questoes')->isNotEmpty() && $request->session()->has('pontos')) {
            return redirect()->route('desafios.quizzes.classificao');
        }
        if (!$request->session()->get('questoes')->isNotEmpty()) {
            $request->session()->forget('questoes');
            return view('site.quiz.questao.nenhuma');
        }

        $response['key'] = $request->session()->get('questoes')->keys()->first();

        $response['questoes'] = isset($novas_questoes) ? $novas_questoes : $request->session()->get('questoes');
        $response['questao'] = $response['questoes']->first();

        $response['respostas'] = Resposta_Quiz::where('id_questao', $response['questao']->id_questao)->get();

        return view('site.quiz.questao.index', $response);
    }

    public function avaliacao(Request $request, $id_questao, $slug_resposta)
    {
        $response['questoes'] = $request->session()->get('questoes');
        $response['questao'] = $response['questoes']->first();
        $key = $request->session()->get('questoes')->keys()->first();

        // $novas_questoes = $request->session()->get('questoes')->forget($key);

        $request->session()->put('questoes', $response['questoes']);
        $estado = Resposta_Quiz::where('id_questao', $id_questao)
            ->where('slug', $slug_resposta)
            ->where('estado', 1)
            ->count();

        if ($estado) {
            if (!$request->session()->has('pontos')) {
                $request->session()->put('pontos', 10);
            } else {
                $request->session()->put('pontos', $request->session()->get('pontos') + 10);
            }
        } else {
            if (!$request->session()->has('pontos')) {
                $request->session()->put('pontos', 0);
            } 
        }
        return view('site.quiz.decisao.index', compact('estado'));
    }
    public function classificao()
    {
        return view('site.quiz.classificacao.index');
    }

}
