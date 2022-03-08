<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Vaga;

class CandidatoController extends Controller
{
    //
 
    protected $candidato;
 
    public function __construct(CandidatoRepository $candidato)
    {
        $this->candidato = $candidato;
      
    }
    public function index($slug_vaga){
        $response['vaga'] =Vaga::where('slug',$slug_vaga)->first();
        $response['candidatos'] =$this->candidato->all()->where('vagas.slug',$slug_vaga)->get();
      return view('admin.candidatos.index',$response);
    }
}
