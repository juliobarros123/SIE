<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Nivel_Quiz;
use App\Http\Controllers\SlugController;

class NivelQuestaoController extends Controller
{
    //
    private $slug_controller;
    public function __construct(SlugController $slug_controller)
    {
        $this->slug_controller = $slug_controller;
    }

    public function criar(){
        return view('admin.quiz.nivel.criar.index');
    }
    public function cadastrar(Request $request){
            //    $request->all()
         $slug=  $this->slug_controller->gerar($request->nivel);
             Nivel_Quiz::create([
                 'nivel'=>$request->nivel,
                 'slug'=>   $slug
             ]);
        return redirect()->route('quizzes.niveis')->with('cadastrado_geral',1);
    }
    public function index(){
      $niveis=  Nivel_Quiz::all();
      return view('admin.quiz.nivel.index',compact('niveis'));
    }
    public function editar($slug){
    
        $nivel=  Nivel_Quiz::where('slug',$slug)->first();
        return view('admin.quiz.nivel.editar.index',compact('nivel'));
      }
      public function actualizar(Request $request, $slug){
        Nivel_Quiz::where('slug',$slug)->update([
            'nivel'=>$request->nivel
         ]);
         return redirect()->back()->with('actualizado_geral',1);
     

      }
      public function eliminar( $slug){
        Nivel_Quiz::where('slug',$slug)->delete();
         return redirect()->back()->with('eliminado_geral',1);
     

      }
    

 
}
