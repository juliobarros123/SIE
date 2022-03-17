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
       $response['empresas']= $this->empresa->all()->get();
   
        return view('admin.relatorio.empresa.vaga.pesquisar.index',$response);
    }
    public function relatorio(Request $request){
        $result=$this->empresa->vagaPorEmpresaContabilizado();
        if($request->id_empresa!="Todas"){
            $result=$result->where('empresas.id',$request->id_empresa);
        }
        if($request->ano!="Todos"){
            $result=$result->whereYear('vagas.created_at',$request->ano);
        }
       
        $response['empresasVagas']=$result->get();
        return view('admin.relatorio.empresa.vaga.relatorio.index',$response);
    }
}
