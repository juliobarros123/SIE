<?php
/* Este sistema esta protegido pelos direitos autoriais do Instituto de Telecomunicações criado ao
abrigo do decreto executivo conjunto nº29/85 de 29 de Abril,
dos Ministérios da Educação e dos Transportes e Comunicações,
publicado no Diário da República, 1ª série nº 35/85, nos termos
do artigo 62º da Lei Constitucional.

contactos:
site:www.itel.gov.ao
Telefone I: +244 931 313 333
Telefone II: +244 997 788 768
Telefone III: +244 222 381 640
Email I: secretariaitel@hotmail.com
Email II: geral@itel.gov.ao*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NotificacaoController;
use App\Http\Controllers\Admin\MatriculaController;
use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Cabecalho;
use App\Models\IdadedeCandidatura;

// use App\Models\Turma;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Matricula;
class HomeController extends Controller
{
    private $menuDisciplina;
    private $notificacao;
    private $matricula;
    public function __construct(NotificacaoController $notificacao,Matricula $matricula)
    {
        $this->matricula = $matricula;
        $this->notificacao = $notificacao;
        $this->menuDisciplina = new MenuController();
        $this->middleware('auth');
    
        
    }
    public function painel()
    {
        

        return view('admin.painel');
    }

    public function raiz()
    {

        $notificacao = $this->notificacao->notificacarMateria();
        $response['notificacao'] = $notificacao;
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $response['disciplinas2'] = $disciplinas2;
        $response['cabecalho'] = Cabecalho::orderby('id', 'desc')->first();

        $anolectivo = AnoLectivo::orderby('id', 'desc')->first();
        if ($anolectivo) {
            $data = $anolectivo->ya_inicio . '-' . $anolectivo->ya_fim;

            $response['AnoLectivo'] = $data;

            // $response['selecionados'] = Alunno::where( [['vc_anoLectivo', $data]] )->count();
            // $response['candidaturas'] = Candidatura::where( [['vc_anoLectivo', $data]] )->count();
            // $response['matriculas'] = Matricula::where( [['vc_anoLectivo', $data]] )->count();
            // $response['idadedecandidatura'] = IdadedeCandidatura::orderby( 'id', 'desc' )->first();

            /* Gráficos */
            $response['Anosgraficos'] = AnoLectivo::orderby('id', 'asc')->get();
            // $response['Cursosgraficos'] = Candidatura::where( [['vc_anoLectivo', $data]] )->orderBy( 'vc_nomeCurso', 'asc' )->groupby( 'vc_nomeCurso' )->get( 'vc_nomeCurso' );

            /* ./Gráficos */
        } else {
            $response[''] = null;
        }
        if (!User::where('current_team_id', Auth::user()->id)->count() && Auth::User()->tipoUtilizador == 'Encarregado') {
            return view('demo.filho.cadastrar.index', $response);
        }
            // $meusMatriculados = DB::table('matriculas')
            //     ->rightJoin('escolas', 'escolas.id', 'matriculas.it_id_escola')
            //     ->join('anoslectivos', 'anoslectivos.id', 'matriculas.it_id_anolectivo')
            //     ->join('users', 'users.id', 'matriculas.it_id_utilizador')
            //     ->join('classes', 'classes.id', 'matriculas.it_id_classe')
            //     ->where('matriculas.it_estado', 1)
            //     ->where('users.current_team_id', Auth::id())
            //     ->select('users.vc_primemiroNome', 'users.vc_apelido', 'matriculas.*', 'classes.vc_classe', 'anoslectivos.ya_inicio', 'anoslectivos.ya_fim', 'escolas.vc_escola')
            //     ->count();
            // if (!$meusMatriculados) {
            //    $result= $this->matriculaController->matriculasDependencias(Auth::user()->id);
           

            
           
   
   
            //    return view('demo.matricula.criar.index', $result);
               
            // }

            $estado = $this->matricula->temFilhoNaoMatriculado(Auth::id());
        
            if (isset($estado['estado']) && $estado['estado'] == true) {
                $result = $this->matricula->matriculasDependencias(Auth::user()->id);
           
                return view('demo.matricula.criar.index', $result)->with('status_demo', 1);
         
    
        }

        return view('admin.index', $response);
    }

}
