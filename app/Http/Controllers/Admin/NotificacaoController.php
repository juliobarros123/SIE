<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Materia;
use App\Models\ClasseDisciplina;
use App\Models\Matricula;
use App\Models\MateriaAluno;
use App\Models\AnoLectivo;
use App\Models\TarefaAluno;
use App\Models\Tarefa;
use App\Models\NotificacaoUtilizador;

class NotificacaoController extends Controller
{
    protected $m_materia,$m_materia_aluno,$m_tarefa_aluno,$it_id_anoLectivoCorrente; 
    public function __construct(Materia $m_materia, MateriaAluno $m_materia_aluno, TarefaAluno $m_tarefa_aluno){

        $this->m_materia=$m_materia;
        $this->m_materia_aluno=$m_materia_aluno;
        $this->m_tarefa_aluno=$m_tarefa_aluno;
        $this->it_id_anoLectivoCorrente=AnoLectivo::where('it_ano_lectivo_corrente',1)->max('it_ano_lectivo_corrente');

    }

    public function criarNotificacao($assunto, $descricao){
        $notificacoes=NotificacaoUtilizador::create([
            'it_id_utilizador'=>1,
            'vc_assunto'=>$assunto,
            'vc_descricao'=>$descricao,
        ]);
    }

    public function tt(){
        //$mat=Matricula::where('it_id_utilizador',Auth::User()->id)
        $classe=Matricula::where('it_id_utilizador',Auth::User()->id)->where('it_id_anolectivo',1)
        ->max('it_id_classe');
        
        
    }
    
    public function notificacarMateria(){
        
        $materias=Materia::all();
        $aluno_materias=MateriaAluno::all();
        //dd($aluno_materias[0]);
        $notificacao_materia=0;
        $quantidade_materia=0;
        $quantidade_materia_aluno=0;
        
        if(Auth::User()->tipoUtilizador == 'Filho')
        {
            $it_id_classe_aluno=Matricula::where('it_id_utilizador',Auth::User()->id)->where('it_id_anolectivo',$this->it_id_anoLectivoCorrente)
            ->max('it_id_classe');
            //dd($it_id_classe_aluno);

            foreach($materias as $materia)
            {
                $it_id_classe_materia=ClasseDisciplina::where('id',$materia->it_id_classeDisciplina)->max('classe_id');
                //dd($it_id_classe_materia);
                if($it_id_classe_aluno== $it_id_classe_materia)
                {
                    $quantidade_materia++;
                    //dd($quantidade_materia);
                    foreach($aluno_materias as $aluno_materia)
                        {//dd($aluno_materia->it_id_utilizador);
                        //it_id_classeDisciplina
                        if($materia->id==$aluno_materia->it_id_materia && 
                            Auth::User()->id== $aluno_materia->it_id_utilizador
                           )
                            //if($materia->id==$aluno_materia->it_id_materia)
                            $quantidade_materia_aluno++;
                        }
                }
                
            }
            if($quantidade_materia-$quantidade_materia_aluno>0)
                $notificacao_materia=$quantidade_materia-$quantidade_materia_aluno;
                //dd( $notificacao_materia);
           
        }
    
        //return $quantidade_materia;
        $notificacao_materia=$notificacao_materia+$this->notificarTarefas();
        //dd($this->notificarTarefas());
        //$notificacao_materia=9;
      //  dd($notificacao_materia);
        return $notificacao_materia;
        
    }

    public function desnotificarMateria(){
        $materias=Materia::all();
        $aluno_materias=MateriaAluno::all();
        $aluno_viu=0;
        foreach($materias as $materia){
        
            
            if($aluno_materias->find(1)){
            foreach($aluno_materias as $aluno_materia){
                
                if($materia->id==$aluno_materia->it_id_materia
                &&   Auth::User()->id== $aluno_materia->it_id_utilizador)
                $aluno_viu++;
                else
                $it_id_materia=$materia->id;
               
                        }
                }
            else
                {
                    $it_id_materia=$materia->id;
                }
     
           
            if($aluno_viu==0)
            {
                $desnotificar=MateriaAluno::create([
                    'it_id_utilizador'=>Auth::User()->id,
                    'it_id_materia'=>$it_id_materia,
            
                    ]);
            }
            else
            $aluno_viu=0;
            
        }

    }

    public function notificarTarefas(){
        $tarefas=Tarefa::all();
        $aluno_tarefas=TarefaAluno::all();
        $notificacao_tarefa=0;
        $quantidade_tarefa=0;
        $quantidade_tarefa_aluno=0;


      //  d($aluno_materia->it_id_utilizador);
    $it_id_classe_aluno=Matricula::where('it_id_utilizador',Auth::User()->id)->where('it_id_anolectivo',$this->it_id_anoLectivoCorrente)
    ->max('it_id_classe');
        //dd($it_id_classe_aluno);


        if(Auth::User()->tipoUtilizador == 'Filho')
        {
            foreach($tarefas as $tarefa)
            {
                 //dd($tarefa->id_classe_disciplinas);
                $it_id_classe_tarefa=ClasseDisciplina::where('id',$tarefa->id_classe_disciplinas)->max('classe_id');
                //dd($it_id_classe_tarefa);
                
                if($it_id_classe_aluno==$it_id_classe_tarefa)
                {
                    $quantidade_tarefa++;
                    //dd($it_id_classe_tarefa);
                    foreach($aluno_tarefas as $aluno_tarefa)
                    {//dd($aluno_tarefa->it_id_utilizador);
                        
                        if($tarefa->id==$aluno_tarefa->it_id_tarefa && 
                        Auth::User()->id== $aluno_tarefa->it_id_utilizador
                           )
                        //if($tarefa->id==$aluno_tarefa->it_id_tarefa)
                        //&& $it_id_classe_aluno==$it_id_classe_tarefa
                        $quantidade_tarefa_aluno++;
                    }

                }
                
              
            }
            if($quantidade_tarefa-$quantidade_tarefa_aluno>0)
            $notificacao_tarefa=$quantidade_tarefa-$quantidade_tarefa_aluno;
            //dd($notificacao_tarefa);
        }
    
        //return $quantidade_tarefa;
        return $notificacao_tarefa;
    }

    public function desnotificarTarefa(){
        $tarefas=Tarefa::all();
        $aluno_tarefas=TarefaAluno::all();
        $aluno_viu=0;
        foreach($tarefas as $tarefa){
        
            
            if($aluno_tarefas->find(1)){
            foreach($aluno_tarefas as $aluno_tarefa){
                
                if($tarefa->id==$aluno_tarefa->it_id_tarefa
                &&   Auth::User()->id== $aluno_tarefa->it_id_utilizador)
                $aluno_viu++;
                else
                $it_id_tarefa=$tarefa->id;
               
                        }
                }
            else
                {
                    $it_id_tarefa=$tarefa->id;
                }
     
           
            if($aluno_viu==0)
            {
                $desnotificar=TarefaAluno::create([
                    'it_id_utilizador'=>Auth::User()->id,
                    'it_id_tarefa'=>$it_id_tarefa,
            
                    ]);
            }
            else
            $aluno_viu=0;
            
        }
    }

    public function verNotificacoes(){
        
        $this->desnotificarMateria();
        $this->desnotificarTarefa();
        $notificacoes=NotificacaoUtilizador::all();
        //dd($notificacoes);
        return view('admin.notificacao.index',compact('notificacoes'));
    }
}
