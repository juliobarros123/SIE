<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Materia;
use App\Models\PerguntaQuiz;
use App\Models\AfirmacaoPerguntaQuiz;
use App\Models\RespostaPerguntaQuiz;
use App\Models\Logger;

class PerguntaQuizController extends Controller
{
    //

    //

    public function __construct()
    {
        $this->Logger = new Logger();
    }

    public function criar()
    {
        $disciplinas= Disciplina::where('it_estado', 1)->get();
        ;
        return  view('admin.quiz.criar', compact('disciplinas'));
    }
    public function vertemas($id_disciplina)
    {
        $disciplina=Disciplina::where('id', $id_disciplina)->where('it_estado', 1)->first();
        $temas= Materia::where('it_id_classeDisciplina', $id_disciplina)->where('it_estado', 1)->get();
       
        return  view('admin.quiz.listarTemas', compact('temas'), compact('disciplina'));
    }

    public function criarPeguntas($id_tema)
    {
        $tema=Materia::find($id_tema);
        return  view('admin.quiz.criarPerguntas', compact('tema'));
    }

    public function cadastrar(request $pergunta, $id_tema)
    {
        if ($this->vrf_tempo($pergunta->time)) {
            $pos= PerguntaQuiz::where('id_materia', $id_tema)->count();
            PerguntaQuiz::create([
            'id'=>'default',
            'time'=>$pergunta->time==null?'10:00:00':$pergunta->time,
            'descricao_perguntas'=>$pergunta->descricao_perguntas,
            'pos'=>$pos+1,
            'id_materia'=>$id_tema
           ]);

            $perguntas=PerguntaQuiz::all();
            if ($pergunta->afirmacao1!="") {
                AfirmacaoPerguntaQuiz::create([
            'id'=>'default',
             'descricao_respostas'=>$pergunta->afirmacao1,
            
             'id_pergunta_quizzes'=>$perguntas->count()
          ]);
                if ($pergunta->afirmacoa_correta=='1') {
                    $RespostaPerguntaQuiz=AfirmacaoPerguntaQuiz::all();
                    RespostaPerguntaQuiz::create([
                    'id'=>'default',
                     'id_afirmacao_pergunta_quizzes'=>$RespostaPerguntaQuiz->count()
                  ]);
                }
            }

            if ($pergunta->afirmacao2!="") {
                AfirmacaoPerguntaQuiz::create([
            'id'=>'default',
             'descricao_respostas'=>$pergunta->afirmacao2,
             'id_pergunta_quizzes'=>$perguntas->count()
          ]);

                if ($pergunta->afirmacoa_correta=='2') {
                    $RespostaPerguntaQuiz=AfirmacaoPerguntaQuiz::all();
                    RespostaPerguntaQuiz::create([
                'id'=>'default',
                 'id_afirmacao_pergunta_quizzes'=>$RespostaPerguntaQuiz->count()
              ]);
                }
            }

            if ($pergunta->afirmacao3!="") {
                AfirmacaoPerguntaQuiz::create([
            'id'=>'default',
             'descricao_respostas'=>$pergunta->afirmacao3,
             'id_pergunta_quizzes'=>$perguntas->count()
          ]);

                if ($pergunta->afirmacoa_correta=='3') {
                    $RespostaPerguntaQuiz=AfirmacaoPerguntaQuiz::all();
                    RespostaPerguntaQuiz::create([
                'id'=>'default',
                 'id_afirmacao_pergunta_quizzes'=>$RespostaPerguntaQuiz->count()
              ]);
                }
            }

            if ($pergunta->afirmacao4!="") {
                AfirmacaoPerguntaQuiz::create([
            'id'=>'default',
             'descricao_respostas'=>$pergunta->afirmacao4,
             'id_pergunta_quizzes'=>$perguntas->count()
          ]);

                if ($pergunta->afirmacoa_correta=='4') {
                    $RespostaPerguntaQuiz=AfirmacaoPerguntaQuiz::all();
                    RespostaPerguntaQuiz::create([
                'id'=>'default',
                 'id_afirmacao_pergunta_quizzes'=>$RespostaPerguntaQuiz->count()
              ]);
                }
            }
 
            return redirect()->route('quizzes.criarPeguntas', $id_tema)->with('status', 1);
        } else {
            return redirect()->back()->with('error', 1);
            ;
        }
    }


    public function actualizar_pergunta(Request $afirmacoes, $id_pergunta)
    {
        if ($this->vrf_tempo($afirmacoes->time)) {
            PerguntaQuiz::find($id_pergunta)->update([
            'time'=>$afirmacoes->time==null?'10:00:00':$afirmacoes->time,
            'descricao_perguntas'=>$afirmacoes->descricao_perguntas
              ]);

            AfirmacaoPerguntaQuiz::find($afirmacoes->id_afirmacao1)->update(['descricao_respostas' => $afirmacoes->afirmacao1]);
            AfirmacaoPerguntaQuiz::find($afirmacoes->id_afirmacao2)->update(['descricao_respostas' => $afirmacoes->afirmacao2]);
            AfirmacaoPerguntaQuiz::find($afirmacoes->id_afirmacao3)->update(['descricao_respostas' => $afirmacoes->afirmacao3]);
            AfirmacaoPerguntaQuiz::find($afirmacoes->id_afirmacao4)->update(['descricao_respostas' => $afirmacoes->afirmacao4]);
            return redirect()->back()->with('status', 1);
        } else {
            return redirect()->back()->with('error', 1);
        }
    }

    public function vrf_tempo($tempo)
    {
        if ($tempo>='00:01' || $tempo==null) {
            return true;
        } else {
            return false;
        }
    }

    public function perguntas_eliminar($id)
    {
        PerguntaQuiz::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou pergunta de quizz');
        return redirect()->back()->with('eliminar', 1);
    }
}
