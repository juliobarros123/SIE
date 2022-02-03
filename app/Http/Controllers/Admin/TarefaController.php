<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ClasseDisciplina;
use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Models\Classe;
use App\Models\User;
use App\Http\Controllers\Admin\MenuController;
use App\Models\Disciplina;
use App\Models\AnoLectivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
use App\Http\Controllers\Admin\NotificacaoController;
use App\Http\Controllers\Admin\DireitoConteudoController;
class TarefaController extends Controller {
    //


    private $Logger,$notificacao;
    private $menuDisciplina;
    private $direito_conteudo;
    public function __construct(NotificacaoController $notificacao,DireitoConteudoController $direito_conteudo)
    {
        $this->menuDisciplina = new MenuController();
        $this->Logger = new Logger();
        $this->notificacao=$notificacao;
        $this->direito_conteudo=$direito_conteudo;
    }
    public function  listar() {

        $anoslectivos = AnoLectivo::all();
        $user=User::find(Auth::id());
        if (  $user->tipoUtilizador == 'Administrador' ) {
            $classesDisciplinas=DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })
            ->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
           ->where('classe_disciplinas.it_estado','=',1)
           ->get();

        }else if($user->tipoUtilizador == 'Professor'){
            $classesDisciplinas=DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })->join('funcionario_escolas', function ($join) {
                $join->on('funcionario_escolas.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })
            ->where('classe_disciplinas.it_estado','=',1)
            ->where('funcionario_escolas.it_id_utilizador', '=', Auth::id())
            ->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
           ->get();
        }



      return view( 'admin.tarefa.pesquisar.index', compact( 'classesDisciplinas' ), compact('anoslectivos'));
    }

    public function pesquisar(Request $dados){
     //   dd($dados);
        //$tarefas = collect();
        //$merge=collect();
        $it_id_classeDisciplina=$dados->it_id_classeDisciplina;
        $vc_anolectivo=$dados->vc_anolectivo;
        return redirect()->route('tarefas.pesquisar2',[$vc_anolectivo,$it_id_classeDisciplina]);

        /**Matricula:: */

        //$anos = explode( '-', $vc_anolectivo );

       /*$user=User::find(Auth::id());
        if (  $user->tipoUtilizador == 'Administrador' ) {

            foreach ( $anos as $ano ) {
                if ( sizeof($this->buscarTarefas( $it_id_classeDisciplina,$ano ) ) ) {
                $merge=    $tarefas->merge( $this->buscarTarefas( $it_id_classeDisciplina,$ano ));
                $merge->all();
                }
            }
            $tarefas=$merge;
        }else if($user->tipoUtilizador == 'Professor'){
            foreach ( $anos as $ano ) {
                if ( sizeof($this->buscarTarefasProfessor( $it_id_classeDisciplina,$ano ) ) ) {
                $merge=    $tarefas->merge( $this->buscarTarefasProfessor( $it_id_classeDisciplina,$ano ));
                $merge->all();
                }
            }
            $tarefas=$merge;
        }
        return view( 'admin.tarefa.index', compact( 'tarefas' ) );*/
    }

    public function pesquisar2($vc_anolectivo, $it_id_classeDisciplina){

           $tarefas = collect();
           $merge=collect();


           $anos = explode( '-', $vc_anolectivo );

          $user=User::find(Auth::id());
           if (  $user->tipoUtilizador == 'Administrador' ) {

               foreach ( $anos as $ano ) {
                   if ( sizeof($this->buscarTarefas( $it_id_classeDisciplina,$ano ) ) ) {
                   $merge=    $tarefas->merge( $this->buscarTarefas( $it_id_classeDisciplina,$ano ));
                   $merge->all();
                   }
               }
               $tarefas=$merge;
           }else if($user->tipoUtilizador == 'Professor'){
               foreach ( $anos as $ano ) {
                   if ( sizeof($this->buscarTarefasProfessor( $it_id_classeDisciplina,$ano ) ) ) {
                   $merge=    $tarefas->merge( $this->buscarTarefasProfessor( $it_id_classeDisciplina,$ano ));
                   $merge->all();
                   }
               }
               $tarefas=$merge;
           }
           return view( 'admin.tarefa.index', compact( 'tarefas' ) );
       }
    public function buscarTarefas($it_id_classeDisciplina,$ano) {

    return  DB::table('tarefas')
    ->join('classe_disciplinas', function ($join) {
        $join->on('tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id');
    })->join('classes', function ($join) {
        $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
    })->join('disciplinas', function ($join) {
        $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
    })->select('tarefas.id as id_tarefa', 'disciplinas.*', 'tarefas.*', 'classes.*')
  ->where('classe_disciplinas.id', '=',  $it_id_classeDisciplina)
  ->whereYear('tarefas.created_at', $ano)
  ->where('tarefas.it_estado', '=', 1)
  ->get();

    }

    public function buscarTarefasProfessor($it_id_classeDisciplina,$ano) {

        return  DB::table('tarefas')
        ->join('classe_disciplinas', function ($join) {
            $join->on('tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id');
        })->join('classes', function ($join) {
            $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
        })->join('disciplinas', function ($join) {
            $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
        })->join('funcionario_escolas', function ($join) {
            $join->on('funcionario_escolas.it_id_classedisciplina', '=', 'classe_disciplinas.id');
        })->select('tarefas.id as id_tarefa', 'disciplinas.*', 'tarefas.*', 'classes.*')
      ->where('classe_disciplinas.id', '=',  $it_id_classeDisciplina)
      ->whereYear('tarefas.created_at', $ano)
      ->where('tarefas.it_estado', '=', 1)
      ->where('funcionario_escolas.it_id_utilizador', '=', Auth::id())
      ->get();

        }

    public function criar() {

        $classesDisciplinas=DB::table('classe_disciplinas')
        ->join('classes', function ($join) {
            $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
        })
        ->join('disciplinas', function ($join) {
            $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');

        })->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
      ->where('classe_disciplinas.it_estado','=',1) ->get();
      $sim=ClasseDisciplina::all()->count();
        return view( 'admin.tarefa.criar.index' ,compact('classesDisciplinas','sim'));

    }

    public function cadastrar( Request $tarefa ) {
        Tarefa::create( $tarefa->all() );
       
        $classe_disciplina=ClasseDisciplina::find($tarefa-> id_classe_disciplinas);
        $classe=Classe::find($classe_disciplina->classe_id)->vc_classe;
        $disciplina=Disciplina::find($classe_disciplina->disciplina_id)->vc_disciplina;
        $this->notificacao->criarNotificacao("Tarefa", 'Foi adicionada uma nova tarefa');
        $this->Logger->Log( 'info', 'Adicionou uma tarefa ao sistema para a disciplina de  '.$disciplina.' da '.$classe.'ª classe');
        return redirect()->back()->with( 'status', 1 );
    }

    public function editar( $id ) {
        $tarefa = Tarefa::find( $id );
      $classeDisciplina=  DB::table('classe_disciplinas')
      ->join('classes', function ($join) {
          $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
      })
      ->join('disciplinas', function ($join) {
          $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');

      })->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
    ->where('classe_disciplinas.it_estado','=',1)
    ->where('classe_disciplinas.id','=',$tarefa->id_classe_disciplinas)
     ->get();


        $classesDisciplinas=DB::table('classe_disciplinas')
        ->join('classes', function ($join) {
            $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
        })
        ->join('disciplinas', function ($join) {
            $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');

        })->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
      ->where('classe_disciplinas.it_estado','=',1) ->get();

        return view( 'admin.tarefa.editar.index', compact( 'tarefa' ),
         ['classesDisciplinas'=>$classesDisciplinas ,'classeDisciplina'=>$classeDisciplina]);
    }

    public function actualizar( Request $tarefa, $id ) {
        Tarefa::find( $id )->update( $tarefa->all() );
        $this->Logger->Log( 'info', 'Actualizou a tarefa de id '.$id );
        return redirect()->back()->with('status',1);


    }

    public function eliminar( $id ) {
        Tarefa::find( $id )->update( ['it_estado'=>0] );
        $this->Logger->Log( 'info', 'Eliminou a tarefa de id '.$id );
        return redirect()->back()->with('eliminar',1);;

    }

    public function respostas( $id ) {
        $user=User::find(Auth::id());
if ($user->tipoUtilizador=='Administrador') {
    $respostas=DB::table('tarefas_submetidas')
        ->join('tarefas', function ($join) {
            $join->on('tarefas.id', '=', 'tarefas_submetidas.it_id_tarefas');
        })->join('users', function ($join) {
            $join->on('tarefas_submetidas.it_id_utilizador', '=', 'users.id');
        })
        ->select('tarefas_submetidas.id as tarefas_submetida as id_tarefa', 'users.*', 'tarefas.*', 'tarefas_submetidas.*')
      ->where('tarefas_submetidas.it_estado', '=', 1)
      ->where('tarefas.id', '=', $id)

       ->get();
}else{

    $respostas=DB::table('tarefas_submetidas')
    ->join('tarefas', function ($join) {
        $join->on('tarefas.id', '=', 'tarefas_submetidas.it_id_tarefas');
    })->join('users', function ($join) {
        $join->on('tarefas_submetidas.it_id_utilizador', '=', 'users.id');
    })
    ->join('matriculas', function ($join) {
        $join->on('matriculas.it_id_utilizador', '=', 'users.id');
    }) ->join('escolas', function ($join) {
        $join->on('escolas.id', '=', 'matriculas.it_id_escola');
    })->join('funcionario_escolas', function ($join) {
        $join->on('escolas.id', '=', 'funcionario_escolas.it_id_escola');
    })
    ->select('tarefas_submetidas.id as tarefas_submetida as id_tarefa', 'users.*', 'tarefas.*', 'tarefas_submetidas.*')
  ->where('tarefas_submetidas.it_estado', '=', 1)
  ->where('tarefas.id', '=', $id)
  ->where('funcionario_escolas.it_id_utilizador', '=', auth::id())
   ->get();
   }

      return view( 'admin.tarefa.resposta.index', compact( 'respostas' ));

    }

    public function  minhaTarefa($id_classe_disciplina){

        if(!$this->direito_conteudo->minha_classe_disciplina($id_classe_disciplina)){
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }

        $notificacao=$this->notificacao->notificacarMateria();
        $tarefas=DB::table('tarefas')
        ->join('classe_disciplinas', function ($join) {
            $join->on('tarefas.id_classe_disciplinas', '=', 'classe_disciplinas.id');
        })->join('classes', function ($join) {
            $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
        })->join('disciplinas', function ($join) {
            $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
        })->select('tarefas.id as id_tarefa', 'disciplinas.*', 'tarefas.*', 'classes.*')
      ->where('tarefas.it_estado', '=', 1)->where('classe_disciplinas.id', '=', $id_classe_disciplina)->get();
      $disciplinas2 = $this->menuDisciplina->listarPorId();
      return view( 'admin.tarefa.index', compact( 'tarefas','notificacao' ),compact('disciplinas2') );
    }
}

