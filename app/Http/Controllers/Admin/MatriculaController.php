<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\DireitoConteudoController;
use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Classe;
use App\Models\Escola;
use App\Models\Logger;
use App\Models\Matricula;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatriculaController extends Controller
{
    private $Logger, $matricula, $direito_conteudo;

    public function __construct(Matricula $matricula, DireitoConteudoController $direito_conteudo)
    {
        $this->matricula = $matricula;
        $this->Logger = new Logger();
        $this->direito_conteudo = $direito_conteudo;
    }

    public function index()
    {
        $anoslectivos = AnoLectivo::all();
        $classes = Classe::all();

        return view('admin.matricula.pesquisar.index', compact('anoslectivos'), compact('classes'));
    }
    public function verClasse($id)
    {

        $id_matricula = $id;

        try {
            $matricula = Matricula::where('id', $id_matricula)->get();
            // dd($matricula);
            return response()->json($matricula[0]['id']);

        } catch (\Exception $exception) {

            return redirect()->back()->with('aviso', '1');
        }
    }

    public function mudarClasse($id, $id_classe)
    {
        $id_matricula = $id;
        $id_classe_matricula = $id_classe;

        try {

            $user = Matricula::find($id_matricula)->update(['it_id_classe' => $id_classe_matricula]);
            return response()->json($user);

        } catch (\Exception $exception) {

            // return redirect()->back()->with('aviso', '1');
        }

    }

    public function create($id_user)
    {
        $Response['users'] = User::where('current_team_id', auth::id())->get();
        $Response['escolas'] = Escola::all();
        $Response['classes'] = Classe::all();
        $Response['anosLectivo'] = AnoLectivo::all();
        $quantidade_filhos = User::where('current_team_id', auth::id())->count();
        $quantidade_escolas = Escola::all()->count();
        $quantidade_classe = Classe::all()->count();
        $quantidade_anoLectivo = AnoLectivo::all()->count();
        $Response['sim'] = $quantidade_filhos * $quantidade_escolas * $quantidade_classe * $quantidade_anoLectivo;
        return view('admin.matricula.criar.index', $Response);

    }

    public function matriculasDependencias($id_user)
    {
        // $Response['users'] = User::where('current_team_id', auth::id())->get();
        $Response['user'] =$this->matricula->temFilhoNaoMatriculado(Auth::id())['educando'];
  
        $Response['escolas'] = Escola::all();
        $Response['classes'] = Classe::all();
        $Response['anosLectivo'] = AnoLectivo::all();
        $quantidade_filhos = User::where('current_team_id', auth::id())->count();
        $quantidade_escolas = Escola::all()->count();
        $quantidade_classe = Classe::all()->count();
        $quantidade_anoLectivo = AnoLectivo::all()->count();
        $Response['sim'] = $quantidade_filhos * $quantidade_escolas * $quantidade_classe * $quantidade_anoLectivo;
        return $Response;

    }

    public function store(Request $request)
    {

        $vf = Matricula::where('it_id_utilizador', $request->it_id_utilizador)
            ->where('it_id_anolectivo', $request->it_id_anolectivo)->count();
        if ($vf == 0) {
            try {
                Matricula::create($request->all());
            } catch (QueryException $ex) {
                return redirect()->back()->with('aviso', 1);
            }
        } else {
            return redirect()->back()->with('aviso', 1);
        }

        //$nomeUtilizador=User::
        $utilizador = User::find($request->it_id_utilizador);
        $utilizador = $utilizador->vc_nomeUtilizador;
        //$utilizador=$utilizador->vc_primemiroNome.' '.$utilizador->vc_nome_meio.' '.$utilizador->vc_apelido;
        $ano = AnoLectivo::find($request->it_id_anolectivo);
        $ano = $ano->ya_inicio . '-' . $ano->ya_fim;
        $this->Logger->Log('info', 'Adicionou uma matrícula da ' . Classe::find($request->it_id_classe)->vc_classe . 'ª classe na escola ' . Escola::find($request->it_id_escola)->vc_escola . '
         no ano lectivo ' . $ano . ' para o utilizador ' . $utilizador);
        return redirect()->back()->with('status', 1);
    }

    public function store_demo(Request $request)
    {

        $vf = Matricula::where('it_id_utilizador', $request->it_id_utilizador)
            ->where('it_id_anolectivo', $request->it_id_anolectivo)->count();
        if ($vf == 0) {
            try {
                Matricula::create($request->all());
            } catch (QueryException $ex) {
                return redirect()->back()->with('aviso_demo', 1);
            }
        } else {
            return redirect()->back()->with('aviso_demo', 1);
        }

        //$nomeUtilizador=User::
        $utilizador = User::find($request->it_id_utilizador);
        $utilizador = $utilizador->vc_nomeUtilizador;
        //$utilizador=$utilizador->vc_primemiroNome.' '.$utilizador->vc_nome_meio.' '.$utilizador->vc_apelido;
        $ano = AnoLectivo::find($request->it_id_anolectivo);
        $ano = $ano->ya_inicio . '-' . $ano->ya_fim;
        $this->Logger->Log('info', 'Adicionou uma matrícula da ' . Classe::find($request->it_id_classe)->vc_classe . 'ª classe na escola ' . Escola::find($request->it_id_escola)->vc_escola . '
         no ano lectivo ' . $ano . ' para o utilizador ' . $utilizador);

        $estado = $this->matricula->temFilhoNaoMatriculado(Auth::id());
        if (isset($estado['estado']) && $estado['estado'] == true) {
        
            $result = $this->matriculasDependencias(Auth::user()->id);
           
            $this->Logger->Log('info', 'Adicionou um educando ao sistema com o nome de utilizador ' . $request->vc_nomeUtilizador);
            return view('demo.matricula.criar.index', $result)->with('status_demo', 1);
        } else {
            $this->Logger->Log('info', 'Adicionou um educando ao sistema com o nome de utilizador ' . $request->vc_nomeUtilizador);
            return redirect('/home')->with('status_demo', 1);
        }

    }

    public function edit($id)
    {

        $Response['matriculas'] = Matricula::find($id);
        if (!$Response['matriculas']) {
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }
        $Response['users'] = User::where('current_team_id', auth::id())->get();
        $Response['escolas'] = Escola::all();
        $Response['classes'] = Classe::all();
        $Response['classe'] = Classe::find($Response['matriculas']->it_id_classe);
        $Response['escola'] = Escola::find($Response['matriculas']->it_id_escola);
        // dd($Response['escola']);

        $Response['anosLectivo'] = AnoLectivo::all();
        return view('admin.matricula.editar.index', $Response);
    }

    public function delete($id)
    {
        Matricula::find($id)->delete();
        $this->Logger->Log('info', 'Eliminou a matricula de id ' . $id);
        //return redirect()->back();
        return redirect()->back()->with('eliminar', 1);
    }

    public function update(Request $request, $id)
    {
        Matricula::find($id)->update([
            'it_id_utilizador' => $request->it_id_utilizador,
            'it_id_escola' => $request->it_id_escola,
            'it_id_anolectivo' => $request->it_id_anolectivo,
            'it_id_classe' => $request->it_id_classe,

        ]);
        $this->Logger->Log('info', 'Actualizou a matrícula de id ' . $id);
        return redirect()->back()->with('status', 1);
    }

    public function listar(Request $dados, Matricula $requisicao)
    {
        $matriculas = collect();
        /**Matricula:: */

        $user = User::find(Auth::id());
        return redirect()->route('matricula.listar3', [$dados->id_classe, $dados->it_id_anolectivo]);
    }

    /*public function listarMatriculasFilho(){

    return view('admin.matricula.filho.index', compact('matriculas'));
    }*/

    public function listar2($Classe, $Anolectivo)
    {
        $matriculas = collect();
        /**Matricula:: */

        $user = User::find(Auth::id());

        $classes = Classe::all();

        if ($user->tipoUtilizador == 'Administrador') {

            $matriculas = $this->matricula->relacaoMatricula($Classe, $Anolectivo);
            if ($Anolectivo == 'Todos' && $Classe == 'Todos') {

                $matriculas = $this->matricula->relacaoMatricula(null, null);
            } else if ($Anolectivo == 'Todos' && $Classe != 'Todos') {

                $matriculas = $this->matricula->relacaoMatricula($Classe, null);
            } else if ($Anolectivo != 'Todos' && $Classe == 'Todos') {

                $matriculas = $this->matricula->relacaoMatricula(null, $Anolectivo);
            } else {

                $matriculas = $this->matricula->relacaoMatricula($Classe, $Anolectivo);
            }
        } else if ($user->tipoUtilizador == 'Encarregado') {

            $matriculas = $this->matricula->relacaoMatriculaFilho($Classe, $Anolectivo, $user->id);
            if ($Anolectivo == 'Todos' && $Classe == 'Todos') {

                $matriculas = $this->matricula->relacaoMatriculaFilho(null, null, $user->id);
            } else if ($Anolectivo == 'Todos' && $Classe != 'Todos') {

                $matriculas = $this->matricula->relacaoMatriculaFilho($Classe, null, $user->id);
            } else if ($Anolectivo != 'Todos' && $Classe == 'Todos') {

                $matriculas = $this->matricula->relacaoMatriculaFilho(null, $Anolectivo, $user->id);
            } else {

                $matriculas = $this->matricula->relacaoMatriculaFilho($Classe, $Anolectivo, $user->id);
            }

        } else {

            $matriculas['opa'] = DB::table('matriculas')
                ->rightJoin('escolas', 'escolas.id', 'matriculas.it_id_escola')
                ->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
                ->join('users', 'users.id', 'matriculas.it_id_utilizador')
                ->join('classes', 'classes.id', 'matriculas.it_id_classe')
                ->where('matriculas.it_id_anolectivo', $Anolectivo)
                ->where('matriculas.it_id_classe', $Classe)
                ->where('matriculas.it_estado', 1)
                ->where('users.current_team_id', Auth::id())
                ->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola')
                ->get();
        }

        return view('admin.matricula.index', compact('matriculas'), compact('classes'));
    }

    /* public function matriculasAnos($dados, $id_classe)
    {

    } */

    /*   public function matriculasTodos()
{
return DB::table('matriculas')
->rightJoin('escolas', 'escolas.id', 'matriculas.it_id_escola')
->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
->join('users', 'users.id', 'matriculas.it_id_utilizador')
->join('classes', 'classes.id', 'matriculas.it_id_classe')
->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola')

->where('matriculas.it_estado', 1)
->get();
}

public function matriculasAno($dados)
{

return DB::table('matriculas')
->join('escolas', 'escolas.id', 'matriculas.it_id_escola')
->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
->join('users', 'users.id', 'matriculas.it_id_utilizador')
->join('classes', 'classes.id', 'matriculas.it_id_classe')
->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola')
->where('matriculas.it_id_anolectivo', $dados->it_id_anolectivo)
->where('matriculas.it_estado', 1)
->get();
}

public function matriculasClasse($id_classe)
{

return DB::table('matriculas')

->join('escolas', 'escolas.id', 'matriculas.it_id_escola')
->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
->join('users', 'users.id', 'matriculas.it_id_utilizador')
->join('classes', 'classes.id', 'matriculas.it_id_classe')
->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola')
->where('classes.id', $id_classe)
->where('matriculas.it_estado', 1)
->get();
} */
}
