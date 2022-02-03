<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Escola;
use Illuminate\Http\Request;
use App\Models\FuncionarioEscola;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Logger;

class FuncionarioEscolaController extends Controller
{
    //
    private $Logger;
    public function __construct()
    {
        $this->Logger = new Logger();
    }
    public function listar()
    {
        $professores = User::where('tipoUtilizador', 'Professor')->get();
        return view('admin.professor.index', compact('professores'));
    }

    public function vincularEscola($id)
    {
        $escolas = Escola::where('it_estado', 1)->get();
        $professor = User::find($id);
        $classesDisciplinas = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();

        return view('admin.professor.vincular.index', ['escolas' => $escolas, 'professor' => $professor, 'classesDisciplinas' => $classesDisciplinas, 'id_professor' => $id]);
    }

    public function vincular(Request $resquest, $id)
    {

        FuncionarioEscola::create($resquest->all());
        $professor=User::find($resquest->it_id_utilizador);
        $escola=Escola::find($resquest->it_id_escola);
        $this->Logger->Log('info', 'Adicionou o professor '.$professor->vc_primemiroNome.' '.$professor->vc_nome_meio.' '.$professor->vc_apelido.' a escola '.$escola->vc_escola);
        return redirect()->back()->with('status', 1);
    }

    public function professorEscola()
    {
        $professoresEscolas = DB::table('funcionario_escolas')
            ->join('escolas', 'escolas.id', 'funcionario_escolas.it_id_escola')
            ->join('users', 'users.id', 'funcionario_escolas.it_id_utilizador')
            ->join('classe_disciplinas', 'classe_disciplinas.id', 'funcionario_escolas.it_id_classedisciplina')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })
            ->select('users.*', 'classes.*', 'escolas.*', 'funcionario_escolas.id as id_fun_escola', 'disciplinas.*', 'funcionario_escolas.*')
            ->where('funcionario_escolas.it_estado', 1)->get();


        return view('admin.professor.professorEscola.index', compact('professoresEscolas'));
    }




    public function editar($id)
    {
        $escolas = Escola::where('it_estado', 1)->get();
        $classesDisciplinas = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();


        $professorEscola = DB::table('funcionario_escolas')
            ->join('escolas', 'escolas.id', 'funcionario_escolas.it_id_escola')
            ->join('users', 'users.id', 'funcionario_escolas.it_id_utilizador')
            ->join('classe_disciplinas', 'classe_disciplinas.id', 'funcionario_escolas.it_id_classedisciplina')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })
            ->select('users.*', 'classes.*', 'escolas.*', 'funcionario_escolas.id as id_fun_escola', 'disciplinas.*', 'funcionario_escolas.*')
            ->where('funcionario_escolas.it_estado', 1)->where('funcionario_escolas.id', $id)->get();

        return view('admin.professor.editar.index', ['escolas' => $escolas, 'professorEscola' => $professorEscola, 'classesDisciplinas' => $classesDisciplinas, 'id_professor' => $id]);
    }


    public function atualizar(Request $resquest, $id)
    {
        $funcionario_escola_anterior=FuncionarioEscola::find($id);

        $escola_anterior=Escola::find($funcionario_escola_anterior->it_id_escola);

        $professor=User::find($funcionario_escola_anterior->it_id_utilizador);

        FuncionarioEscola::find($id)->update($resquest->all());
        $funcionario_escola_actual=FuncionarioEscola::find($id);

        $escola_actual=Escola::find($funcionario_escola_actual->it_id_escola);
        $funcionario_escola_actual=FuncionarioEscola::find($id);
        

        $this->Logger->Log('info', 'Actualizou o professor '.$professor->vc_primemiroNome.' '.$professor->vc_nome_meio.' '.$professor->vc_apelido.' da escola '.$escola_anterior->vc_escola.' para a '.
        $escola_actual->vc_escola);
        return redirect()->back()->with('up', 1);
    }
    public function excluir($id)
    {
        $funcionario_escola_actual=FuncionarioEscola::find($id);
        FuncionarioEscola::find($id)->delete();
        $professor=User::find($funcionario_escola_actual->it_id_utilizador);
        $escola=Escola::find($funcionario_escola_actual->it_id_escola);
        $this->Logger->Log('info', 'Eliminou o professor '.$professor->vc_primemiroNome.' '.$professor->vc_nome_meio.' '.$professor->vc_apelido.' da escola '.$escola->vc_escola);
        return redirect()->back()->with('delete', 1);
    }
}
