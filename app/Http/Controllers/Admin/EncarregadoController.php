<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\UtilizadorRepository;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Logger;
use App\Models\Materia;
use App\Models\MateriaAluno;
use App\Models\TarefaAluno;
use App\Http\Controllers\Admin\DireitoConteudoController;

class EncarregadoController extends Controller
{
 
    use PasswordValidationRules;

    protected $user;
    private $Logger;
    private $direito_conteudo;
    public function __construct(UtilizadorRepository $user,DireitoConteudoController $direito_conteudo)
    {
        $this->direito_conteudo=$direito_conteudo;
        $this->user = $user;
        $this->Logger = new Logger();
    }

    public function verMateria($id_user){

        if(!$this->direito_conteudo->meu_filho($id_user)){
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }
    // $data['materias']  = DB::table('materias')
    //     ->join("classe_disciplinas","materias.it_id_classeDisciplina","classe_disciplinas.id")
    //     ->join("classes","classe_disciplinas.classe_id","classes.id")
    //     ->join("materia_alunos","materias.id","materia_alunos.it_id_materia")
    //     ->join("disciplinas","classe_disciplinas.disciplina_id","classes.id")
    //     ->where("it_id_utilizador",$id_user)
    //     ->get();
    
        $data['materias'] = DB::table('materias')
        ->join('horarios', function ($join) {
            $join->on('horarios.id', '=', 'materias.id_horarios');
        })
        ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
        ->join('anoslectivos', function ($join) {
            $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
        })
        ->join('classe_disciplinas', function ($join) {
            $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
        })->join('classes', function ($join) {
            $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
        })->join('disciplinas', function ($join) {
            $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
        })
        ->join('matriculas', function ($join) {
            $join->on('matriculas.it_id_classe', '=', 'classes.id');
        })->join('users', function ($join) {
            $join->on('matriculas.it_id_utilizador', '=', 'users.id');
        })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*', 'materias.*', 'materias.id as id_m')
        ->where('materias.it_estado', 1)
        ->where('matriculas.it_id_utilizador', $id_user)
        ->get();

        return  view("site.encarregado.verMateria.index",$data);

    }
    public function filhos($id)
    {
        $users = User::where('current_team_id', $id)->get();
    
        return view('site.encarregado.verFilhos.index', compact('users'));
    }
    public function verTarefa($id_user){
        if(!$this->direito_conteudo->meu_filho($id_user)){
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }
        $data['tarefas'] = DB::table('tarefas')
        ->join('classe_disciplinas', function ($join) {
            $join->on('tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id');
        })->join('classes', function ($join) {
            $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
        })->join('disciplinas', function ($join) {
            $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
        })->join('matriculas', function ($join) {
            $join->on('matriculas.it_id_classe', '=', 'classes.id');
        })->where('tarefas.it_estado', '=', 1)
        ->where('matriculas.it_id_utilizador', '=',$id_user)
         ->select('tarefas.id as id_tarefa', 'disciplinas.*', 'tarefas.*', 'classes.*')->get();
        // dd($data['tarefas']);

        return view("site.encarregado.verTarefa.index",$data);

    }
}
