<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class DireitoConteudoController extends Controller
{
    //

  
    public function dados_classe_disciplina(){
        return DB::table('classe_disciplinas')
            ->join('classes', 'classe_disciplinas.classe_id', '=', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', '=', 'disciplinas.id')
            ->join('matriculas', 'matriculas.it_id_classe', '=', 'classes.id')
            ->join('users','matriculas.it_id_utilizador', '=', 'users.id')
            ->select( 'disciplinas.*', 'classes.*', 'matriculas.*','users.*');

    }


    public function minha_classe_disciplina($id_classe_disciplina){
        // dd($this->dados_classe_disciplina()->get());
     $linha=$this->dados_classe_disciplina()->where('classe_disciplinas.id',$id_classe_disciplina)->where('users.id',Auth::id())->count();
     $resposta= $this->decidir($linha);
     return $resposta;
    }

    public function minha_tarefa($id_classe_disciplina){
        // dd($this->dados_classe_disciplina()->get());
     $linha=$this->dados_classe_disciplina()->where('classe_disciplinas.id',$id_classe_disciplina)->where('users.id',Auth::id())->count();
     $resposta= $this->decidir($linha);
     return $resposta;
    }

    public function decidir($estado){
        if ($estado) {
            return true;
          }else if (Auth::User()->tipoUtilizador == 'Administrador' || Auth::User()->tipoUtilizador=='Desenvolvedor') {
              return true;
          }else{
              return false;
          }
    }


    public function dados_pai_filho(){
        return DB::table('users')
        ;
    }
    public function meu_filho($id_filho){
        $linha=$this->dados_pai_filho()->where('users.id',$id_filho)->where('users.current_team_id',Auth::id())->count();
      
        $resposta= $this->decidir($linha);
        return $resposta;
    }

}
