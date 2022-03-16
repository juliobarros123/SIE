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
}
