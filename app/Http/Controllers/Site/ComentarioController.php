<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Comentario\ComentarioRepository;
class ComentarioController extends Controller
{
    //
    protected $comentario;

    public function __construct(ComentarioRepository $comentario)
    {
        $this->comentario = $comentario;
      
    }
    public function cadastrar(Request $request){

        $this->comentario->salvar($request->all());
        return redirect()->back()->with('comentario_salvo', '1');

    }
}
