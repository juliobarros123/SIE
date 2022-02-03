<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria_Quiz;
use App\Http\Controllers\SlugController;
class CategoriaQuizController extends Controller
{
    //

    private $slug_controller;
    public function __construct(SlugController $slug_controller)
    {
        $this->slug_controller = $slug_controller;
    }

    public function criar(){
        return view('admin.quiz.categoria.criar.index');
    }
    public function cadastrar(Request $request){
            //    $request->all()
            
         $slug=  $this->slug_controller->gerar($request->categoria);
             Categoria_Quiz::create([
                 'categoria'=>$request->categoria,
                 'slug'=>   $slug
             ]);
        return redirect()->route('quizzes.categorias')->with('cadastrado_geral',1);
    }
    public function index(){
    
      $categorias=  Categoria_Quiz::all();
      return view('admin.quiz.categoria.index',compact('categorias'));
    }
    public function editar($slug){
    
        $categoria=  Categoria_Quiz::where('slug',$slug)->first();
        return view('admin.quiz.categoria.editar.index',compact('categoria'));
      }
      public function actualizar(Request $request, $slug){
        Categoria_Quiz::where('slug',$slug)->update([
            'categoria'=>$request->categoria
         ]);
         return redirect()->back()->with('actualizado_geral',1);
     

      }
      public function eliminar( $slug){
        Categoria_Quiz::where('slug',$slug)->delete();
         return redirect()->back()->with('eliminado_geral',1);
     

      }
    

}
