<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Empresa\EmpresaRepository;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
class GraficoController extends Controller
{
    //
    protected $empresa;
    protected $candidato;
    protected $vaga;
    public function __construct(EmpresaRepository $empresa,CandidatoRepository $candidato,VagaRepository $vaga )
    {
        $this->empresa = $empresa;
        $this->candidato = $candidato;
        $this->vaga=$vaga;
    }

    public function vagaPorEmpresas(){
        $empresas = array();
        $vagas = array();
        $results=$this->empresa->vagaPorEmpresaContabilizado()->get();
    // dd(   $results);
        foreach($results as $item ){
            array_push($empresas, $item->nome);
            array_push($vagas, $item->vagas);
        }
     
        $vagaPorEmpresas = [
            'empresas' => $empresas,
            'vagas' => $vagas
           
        ];
          $dados['vagaPorEmpresas']=$vagaPorEmpresas;
         $dados['candidatosPorVaga']=$this->candidatosPorVaga();
         $dados['candidatosAceitePorEmpresa']=$this->candidatosAceitePorEmpresa();
        return response()->json($dados);
      

    }
    public function candidatosPorVaga(){
        $funcao = array();
        $candidatos = array();
        $results=$this->vaga->candidatoPorVagaContabilizado()->get();
     
        foreach($results as $item ){
            array_push($funcao, $item->funcao);
            array_push($candidatos, $item->candidatos);
        }
     
        $dados = [
            'funcao' => $funcao,
            'candidatos' => $candidatos
           
        ];

        return    $dados;
    }
    public function candidatosAceitePorEmpresa(){
        $empresas = array();
        $candidatos = array();
        $results=$this->empresa->candidatoAceitePorEmpresasContabilizado()->get();
    //  dd( $results);
        foreach($results as $item ){
            array_push($empresas, $item->nome);
            array_push($candidatos, $item->candidatos);
        }
     
        $dados = [
            'empresas' => $empresas,
            'candidatos' => $candidatos
           
        ];

        return    $dados;
    }
}
