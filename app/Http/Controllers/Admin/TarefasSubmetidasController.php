<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TarefasSubmetidas;
use App\Models\Disciplina;
use App\Models\ClasseDisciplina;
use App\Models\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Matricula;
use App\Http\Controllers\Admin\DireitoConteudoController;
use App\Http\Controllers\Admin\MenuController;
class TarefasSubmetidasController extends Controller
{
    private $Logger;
    private $direito_conteudo;
    private $menuDisciplina;
    public function __construct(User $utilizador,Matricula $matricula,DireitoConteudoController $direito_conteudo)
    {
        $this->Logger = new Logger();
        $this->direito_conteudo=$direito_conteudo;
        $this->menuDisciplina = new MenuController();
    }
    public function index()
    {/*TarefasSubmetidas::where('it_estado', 1)->get(); */
        $tarefas = DB::table('tarefas')
            ->join('classe_disciplinas', function ($join) {
                $join->on('tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('tarefas.id as id_tarefa', 'disciplinas.*', 'tarefas.*', 'classes.*')
            ->where('tarefas.it_estado', '=', 1)->get();

        return view('admin.tarefas_submetidas.index', compact('tarefas'));
    }

    public function submeter($id)
    { 

      $dados['disciplinas2'] = $this->menuDisciplina->listarPorId();
      $dados['id']=$id;
       $id_classe_disciplina=$this->id_classe_disciplina($id);
       if(!$this->direito_conteudo->minha_classe_disciplina($id_classe_disciplina)){
        return redirect()->back()->with('acao_nao_autorizado', 1);
       }
        return view('admin.tarefas_submetidas.criar.index', $dados);
    }

   public function id_classe_disciplina($id_tarefa){
             $result_set= DB::table('tarefas')
             ->join('classe_disciplinas','tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id')
             ->where('tarefas.it_estado', '=', 1)
             ->where('tarefas.id', '=', $id_tarefa)
             ->first();
             return isset($result_set->id_classe_disciplinas)?$result_set->id_classe_disciplinas:0;
   }

    public function cadastrar(Request $request, $id, $id_user)
    {

        if ($request->hasFile('vc_pdf') && $request->file('vc_pdf')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->vc_pdf->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->vc_pdf->storeAs('public/pdfTarefaSubmeter', $nameFile);
            $upload = substr( $upload ,7,strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {

                TarefasSubmetidas::create([
                    'vc_tarefa' => $request->vc_tarefa,
                    'vc_pdf' => $upload,
                    'it_id_tarefas' => $id,
                    'it_id_utilizador' => $id_user,
                    //'it_id_matricula'=>$matricula->where('it_id_classe',Tarefa::find($id)->where('id_classe_disciplinas'))->max();//$utilizador->id;

                ]);
                $this->Logger->Log('info', 'Submeteu reposta da terefa de id '. $id.' e nomeou-a de '.$request->vc_tarefa);
                return redirect()->back()->with('status', 1);
            }
        }
    }

    public function edit($id)
    {
        $Response['tarefas'] =  TarefasSubmetidas::find($id);
        return view('admin.tarefas_submetidas.editar.index', $Response);
    }

    public function update(Request $request, $id)
    {
        $actualizacao=TarefasSubmetidas::find($id)->update([
            'vc_tarefa' => $request->tarefa,
            'dt_data_entrega' => $request->data,
            'vc_descricao' => $request->descricao,
            'it_id_classe_disciplina' => $request->classe,



        ]);
        $this->Logger->Log('info', 'Actualizou a resposta submetida da terefa de id '.$actualizacao->it_id_tarefas);
        return redirect()->route('tarefas_submetidas.index');
    }

    public function delete($id)
    {
        TarefasSubmetidas::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou a tarefa submetida de id '.$id);
        return redirect()->back();
    }
}