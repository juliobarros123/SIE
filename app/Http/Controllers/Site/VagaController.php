<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Empresa\EmpresaRepository;
class VagaController extends Controller
{
    //
  
    public function vagas(){
        $response['vagas']=vagas_disponiveis()->get();
    
return view('site.vaga.index',$response);
    }

    public function pesquisar(Request $pesquisar)
    {
        $response['vagas'] =  vagas_disponiveis()->where('vagas.funcao', 'like', '%' . $pesquisar->vaga . '%')->get();
        // dd( $response['vagas'] );
        $dados['pesquisa']=1;
        return view('site.vaga.index', $response);
    }
}
