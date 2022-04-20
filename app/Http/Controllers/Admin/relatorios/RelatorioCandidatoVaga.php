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
       $response['vagas']=         $vagas=   $this->vaga->vagasMinhasEmpresas(Auth::User()->id)->get();
    //    dd(       $response['vagas']);
    //    $this->vaga->vagasMinhasEmpresas( Auth::user()->id)->get();
  
        return view('admin.relatorio.empresa.candidatos.pesquisar.index',$response);
    }
    public function relatorio(Request $request){
    
        $result=$this->candidato->candidatoPorVagaContabilizado();
        $vaga=$this->vaga->all()->where('vagas.id',$request->id_vaga)->first();
     
        if($request->id_vaga!="Todas"){
            $result=$result->where('vagas.id',$request->id_vaga);
        }
       
        $response["css"] = file_get_contents("admin/css/relatorio/candidatos-vaga/estilo.css");
  
        $response['candidatosVagas']=$result->get();
    
        $response['vaga']=$request->id_vaga!="Todas"?$vaga->funcao:$request->id_vaga;
        $response['nomeEmpresa']=isset($vaga->nome)?$vaga->nome:$request->id_vaga;
        $mpdf = new \Mpdf\Mpdf();
        $html = view("admin/relatorio/empresa/candidatos/relatorio/index",$response);
        $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

       //  $html = view("admin/pdfs/alunos_municipio/index", $response);
       //  $mpdf->writeHTML($html);
        $mpdf->Output("alunos por municípios.pdf", "I");

    
}
}
