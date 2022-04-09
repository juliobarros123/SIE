<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ClasseDisciplina;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Empresa\EmpresaRepository;
use App\Repositories\Eloquent\Comentario\ComentarioRepository;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    protected $empresa;
    protected $comentario;
    public function __construct(EmpresaRepository $empresa,ComentarioRepository $comentario)
    {
        $this->empresa = $empresa;
        $this->comentario=$comentario;
      
    }
    public function index()
    {
    
    
        if (Auth::id()) {
            return redirect()->route('home');
        }else{
            $response['empresas'] =$this->empresa->all()->get();
            $response['comentarios'] =$this->comentario->all()->where('estado',1)->get();
            // dd(   $response['comentarios']);
            return view('site.homepage_1', $response);
        }
    
       
    }
    public function bemVindo()
    {
    
    
            $response['empresas'] =$this->empresa->all()->get();
            $response['comentarios'] =$this->comentario->all()->where('estado',2)->get();
          
            return view('site.homepage_1', $response);
        
    
       
    }
    
}