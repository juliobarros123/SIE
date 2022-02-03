<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\MenuController;
use App\Models\UnidadeMateria;
class MateriaFilhoEducandoController extends Controller
{
    //

    private $menuDisciplina;

    public function __construct()
    {

        $this->menuDisciplina = new MenuController();
 
    }

    public function disciplinas($id_educando){
        $disciplinas= DB::table('matriculas')
        ->join('classes', 'classes.id', '=', 'matriculas.it_id_classe')
        ->join('classe_disciplinas', 'classe_disciplinas.classe_id', '=', 'classes.id')
        ->join('disciplinas', 'classe_disciplinas.disciplina_id', '=', 'disciplinas.id')
        ->join('users', 'users.id', '=', 'matriculas.it_id_utilizador')
        ->where('users.id', '=', $id_educando)
        ->select('users.id as id_usuario','disciplinas.id as id_disciplina','disciplinas.vc_disciplina as vc_disciplina', 'classe_disciplinas.id as id_classe_disciplina','matriculas.id as id_matricula')
        ->get();
   
        // if(!$this->direito_conteudo->meu_filho($id_user)){
        //     return redirect()->back()->with('acao_nao_autorizado', 1);
        // }
        $response['disciplinas']=$disciplinas;
        $response['unidades']=UnidadeMateria::all();
    return response()->json( $response);
      
    }

    public function getUnidades(){
        $unidades=UnidadeMateria::all();
        return response()->json( $unidades);
    }
}
