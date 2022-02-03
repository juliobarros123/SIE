<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SlugController;
use App\Models\Categoria_Quiz;
use App\Models\Nivel_Quiz;
use App\Models\Questao_Quiz;
use App\Models\Resposta_Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestaoController extends Controller
{
    //

    private $slug_controller;
    public $questao_Quiz;
    public function __construct(SlugController $slug_controller, Questao_Quiz $questao_Quiz)
    {
        $this->slug_controller = $slug_controller;
        $this->questao_Quiz=$questao_Quiz;
     
    }

    public function criar()
    {
        $response= $this->dados();
       
        return view('admin.quiz.questao.criar.index', $response);
    }
    public function dados(){
        $response['niveis'] = Nivel_Quiz::all();
        $response['categorias'] = Categoria_Quiz::all();
        $response['questoes'] = Questao_Quiz::all();
        $response['classes_disciplinas'] = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');

            })->select('classe_disciplinas.*', 'classe_disciplinas.*', 'disciplinas.vc_disciplina', 'classes.vc_classe')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();

            return  $response;
    }
    public function cadastrar(Request $request)
    {
        //    $request->all()
      

        $slug = $this->slug_controller->gerar($request->questao);
        $questao = Questao_Quiz::create([
            'questao' => $request->questao,
            'id_nivel' => $request->id_nivel,
            'id_categoria' => $request->id_categoria,
            'id_classe_disciplina' => $request->it_id_classedisciplina,
            'time'=> $request->time==null?'10:00:00':$request->time,
            'slug' => $slug,
        ]);
        if ($questao) {
            $this->cadastrar_resposta($request, $questao->id);
        }
        return redirect()->route('quizzes.questoes')->with('cadastrado_geral', 1);
    }
    public function cadastrar_resposta(Request $request, $id_questao)
    {

        $s = $this->cadastrar_resposta_file($request, $id_questao);

        $this->cadastrar_resposta_texto($request, $id_questao);
    }

    public function activar_resposta(Request $request, $id_resposta)
    {

        $respostas = $request->except('it_id_classedisciplina', 'id_nivel', 'id_categoria', '_token', 'questao','time');
        $result1 = Resposta_Quiz::find($id_resposta);
        if (isset($respostas["resposta" . $request->afirmacoa_correta]) && $respostas["resposta" . $request->afirmacoa_correta] == $result1->resposta) {

            $estado = Resposta_Quiz::find($id_resposta)->update(
                ['estado' => 1],
            );
            if ($estado) {

                return true;
            } else {
                return false;
            }
        }

    }
    public function cadastrar_resposta_file(Request $request, $id_questao)
    {

        $inputs_file = '';
        $slug = $this->slug_controller->gerar($request->questao);
        $respostas = $request->file();
        foreach ($respostas as $resposta) {
            $imagem = $this->uploadImg($resposta);

            $result = Resposta_Quiz::create(
                [

                    'resposta' => $imagem,
                    'slug' => $slug,
                    'id_questao' => $id_questao,
                ]
            );
            $inputs_file = $inputs_file . '' . $resposta;
            $this->activar_resposta($request, $result->id);
        }
        return $inputs_file;
    }
    public function cadastrar_resposta_texto(Request $request, $id_questao)
    {
        $respostas = $request->except('it_id_classedisciplina', 'id_nivel', 'id_categoria', '_token', 'questao','afirmacoa_correta','time');

        foreach ($respostas as $resposta) {

            if (!is_object($resposta)) {

                $slug = $this->slug_controller->gerar($request->questao);
                $result = Resposta_Quiz::create(
                    [
                        'resposta' => $resposta,
                        'slug' => $slug,
                        'id_questao' => $id_questao,
                    ]
                );
                $this->activar_resposta($request, $result->id);
            }

        }

    }
    public function uploadImg($coluna)
    {
        // Verifica se informou o arquivo e se é válid
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $coluna->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload:
        $upload = $coluna->storeAs('public/quiz/repostas/file', $nameFile);
        $upload = substr( $upload ,7,strlen($upload));
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

        // Verifica se NÃO deu certo o upload ( Redireciona de volta )
        if (!$upload) {
            return redirect()
                ->back()
                ->with('error', 'Falha ao fazer upload')
                ->withInput();
        } else {
            return $upload;

        }

    }

    public function index()
    {
        $questoes =  $response= $this->questao_Quiz->dados()->select('questao__quizzes.*','questao__quizzes.*','nivel__quizzes.nivel','disciplinas.vc_disciplina',
        'nivel__quizzes.nivel',
        'classes.vc_classe')->get();
        return view('admin.quiz.questao.index', compact('questoes'));
    }
    public function editar($slug)
    {

     
        $response=$this->dados();
        $response['questao']=  $this->questao_Quiz->dados()->where('questao__quizzes.slug',$slug)
        ->select('questao__quizzes.slug as slug_questao','questao__quizzes.*',
        'classe_disciplinas.id', 
        'classe_disciplinas.*',
         'disciplinas.vc_disciplina',
          'nivel__quizzes.nivel',
          'classes.vc_classe',
          'categoria__quizzes.categoria'
          )
        ->first();
        // dd( $response['questao']);
        // $response['questao']->where('questao__quizzes.slug',$slug)
        // dd( $response['questao']);
        $questao = Questao_Quiz::where('slug', $slug)->first();
      
        return view('admin.quiz.questao.editar.index',$response);
    }
    public function actualizar(Request $request, $slug)
    {
        // // dd($request);
        // dd(   Questao_Quiz::where('slug', $slug)->get());
        // dd( $request);
        Questao_Quiz::where('slug', $slug)->update([
            'questao' => $request->questao,
            'id_nivel' => $request->id_nivel,
            'id_categoria' => $request->id_categoria,
            'id_classe_disciplina' => $request->it_id_classedisciplina
        ]);
     
        return redirect()->back()->with('actualizado_geral', 1);
    }
    
    public function eliminar($slug)
    {
        Questao_Quiz::where('slug', $slug)->delete();
        return redirect()->back()->with('eliminado_geral', 1);

    }
    public function join(){
        DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');

            })->select('classe_disciplinas.id', 'classe_disciplinas.*', 'disciplinas.vc_disciplina', 'classes.vc_classe')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();
    }
}
