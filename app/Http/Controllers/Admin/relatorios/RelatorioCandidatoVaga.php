<?php

namespace App\Http\Controllers\Admin\Relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
class RelatorioCandidatoVaga extends Controller
{
    //
    protected $candidato;
    protected $vaga;
    protected $Logger;
    public function __construct(CandidatoRepository $candidato,VagaRepository $vaga)
    {
        
        $this->Logger = new Logger();
        $this->candidato = $candidato;
        $this->vaga = $vaga;
    }

    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
  
    public function gerar(){
       $response['vagas']= $this->vaga->vagasMinhasEmpresas( Auth::user()->id)->get();
  
        return view('admin.relatorio.empresa.candidatos.pesquisar.index',$response);
    }
    public function relatorio(Request $request){
    
        $result=$this->candidato->candidatoPorVagaContabilizado();
      
        if($request->id_vaga!="Todas"){
            $result=$result->where('vagas.id',$request->id_vaga);
        }
       dd( $result->get());
       
        // $response['empresasVagas']=$result->get();
        // return view('admin.relatorio.empresa.vaga.relatorio.index',$response);
    }
}
