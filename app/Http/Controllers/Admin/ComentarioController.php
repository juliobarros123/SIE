<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comentario;
use App\Repositories\Eloquent\Comentario\ComentarioRepository;
class ComentarioController extends Controller
{
    //
    protected $comentario;

    public function __construct(ComentarioRepository $comentario)
    {
        $this->comentario = $comentario;
      
    }
    public function index(){
        $response['comentarios']=  $this->comentario->all()->get();
        return view('admin.comentario.index', $response);
    
    }
    public function aprovar($slug_comentario)
    {

        $estado = Comentario::where('slug', $slug_comentario)->update([
            'estado' => 2,
        ]);
        if ($estado) {
            return redirect()->back()->with('aprovado', 1);
        }

    }

    public function reprovar($slug_comentario)
    {

        $estado = Comentario::where('slug', $slug_comentario)->update([
            'estado' => 2,
        ]);
        if ($estado) {
            return redirect()->back()->with('reprovado', 1);
        }
    }
}
