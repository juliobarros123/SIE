<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Empresa\EmpresaRepository;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;

class RelatorioEmpresaController extends Controller
{
    protected $empresa;
    protected $Logger;
    public function __construct(EmpresaRepository $empresa)
    {
        $this->empresa = $empresa;
        $this->Logger = new Logger();
    }

    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
  
    public function gerar(){
       $response['empresas']="";
       if(Auth::User()->tipoUtilizador == 'Administrador'){
       $response['empresas']=$this->empresa->all()->get();
    }else if(Auth::User()->tipoUtilizador == 'Empresario'){
       $response['empresas']=$this->empresa->all()->where('empresas.propreitario',Auth::id())->get();
    }
   
        return view('admin.relatorio.empresa.vaga.pesquisar.index',$response);
    }
    public function relatorio(Request $request){
        $empresa=$this->empresa->all()->where('empresas.id',$request->id_empresa)->first();
        $response['nomeEmpresa']=isset($empresa->nome)?$empresa->nome:$request->id_empresa;
        $result=$this->empresa->vagaPorEmpresaContabilizado();
        if($request->id_empresa!="Todas"){
            $result=$result->where('empresas.id',$request->id_empresa);
        }
        if($request->ano!="Todos"){
            $result=$result->whereYear('vagas.created_at',$request->ano);
        }
        $response['ano']=$request->ano;
   
        $response['empresasVagas']=$result->get();
    
        $response["css"] = file_get_contents("admin/css/relatorio/candidatos-vaga/estilo.css");
        $html = view("admin.relatorio.empresa.vaga.relatorio.index",$response);
       
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
            $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
            $mpdf->Output("alunos por municípios.pdf", "I");
       
          
    }
}
