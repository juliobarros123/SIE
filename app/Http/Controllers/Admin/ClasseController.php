<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClasseDisciplina;
use App\Models\Disciplina;
use App\Models\Escola;
use Illuminate\Support\Facades\DB;
use App\Models\AnoLectivo;

use Illuminate\Http\Request;
use App\Models\Logger;

class ClasseController extends Controller {
    //
    private $Logger;

    public function __construct()
 {
        $this->Logger = new Logger();
    }

    public function  listar() {
      $classes  = DB::table( 'classes' )->where('it_estado',1)
        /*->join( 'escolas', function ( $join ) {
        $join->on( 'escolas.id', '=', 'classes.it_id_escola');
        })*/->select('classes.*','classes.id as id_classe')
      ->get();
    
        return view( 'admin.classe.index', compact( 'classes' ) );

    }//hh
    public function criar() {
        $escolas = Escola::all();
        return view( 'admin.classe.criar.index', compact( 'escolas' ) );

    }

    public function cadastrar( Request $classe ) {
        $estado=$this->vrf_classe_existente($classe->vc_classe);
        if (!$estado) {
            Classe::create($classe->all());
            $this->Logger->Log('info', 'Adicionou a '.$classe->vc_classe.'ª classe ao sistema');
            return redirect()->back()->with('status', 1);
        }else{
            return redirect()->back()->with('has', 1);  
        }
    }

    public function editar( $id ) {
        $classe =   Classe::find( $id );
         $escolas = Escola::all();
        $escola =  Escola::find( $classe->it_id_escola );
        return view( 'admin.classe.editar.index', compact( 'classe' ), ['escolas' =>$escolas, 'escola' => $escola] );
    }

    public function actualizar( Request $classe, $id ) {
        $classe_antiga=Classe::find($id);
        $estado=$this->vrf_classe_existente($classe->vc_classe);
        if (!$estado) {
            Classe::find($id)->update($classe->all());
            $this->Logger->Log('info', 'Actualizou a '.$classe_antiga->vc_classe.'ª classe para '.$classe->vc_classe.'ª classe');
            return redirect()->route('classes')->with('status', 1);
        }else{
            return redirect()->back()->with('has', 1);  
        }
    }

    public function eliminar( $id ) {
        $classe=Classe::find( $id );
        Classe::find( $id )->update( ['it_estado'=>0] );
        $this->Logger->Log( 'info', 'Eliminou a '.$classe->vc_classe.'ª classe do sistema');
       // return redirect()->route( 'classes' );
       // return redirect()->route( 'classes' );
       return redirect()->back()->with('eliminar', 1);
    }

    public function vrf_classe_existente($vc_classe){
        return Classe::where('vc_classe',$vc_classe)->count();
            }
}
