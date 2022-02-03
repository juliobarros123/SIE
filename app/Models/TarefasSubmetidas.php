<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TarefasSubmetidas extends Model
 {
    use HasFactory;
    protected $fillable = [
        'vc_tarefa',
        'vc_pdf',
        'it_id_tarefas',
        'it_id_utilizador',
        'it_estado',
        'it_id_matricula'
    ];

    public function tarefasSubmetidas($it_id_classeDisciplina,$it_id_anoLectivo){
     
        if($it_id_classeDisciplina==0 && $it_id_anoLectivo==0 )
        {
            $alunoClasse = DB::table( 'tarefas_submetidas')
        ->where('tarefas_submetidas.it_estado', 1)
        ->join( 'tarefas', 'tarefas_submetidas.it_id_tarefas', 'tarefas.id' )
        ->join( 'matriculas', 'tarefas_submetidas.it_id_matricula', 'matriculas.id' )
        ->join( 'classe_disciplinas', 'tarefas.id_classe_disciplinas', 'classe_disciplinas.id' )
        ->join( 'classes', 'classe_disciplinas.classe_id', 'classes.id' )
        ->join( 'disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id' )
        ->select('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina',DB::raw('count(tarefas_submetidas.id) as quantidade'))
        ->groupBy('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina')
        ->get();
            
        }

        else if($it_id_classeDisciplina==0 && $it_id_anoLectivo>0)
        {
        $alunoClasse = DB::table( 'tarefas_submetidas')
        ->where([['tarefas_submetidas.it_estado', 1],['matriculas.it_id_anolectivo',$it_id_anoLectivo]])
        ->join( 'tarefas', 'tarefas_submetidas.it_id_tarefas', 'tarefas.id' )
        ->join( 'matriculas', 'tarefas_submetidas.it_id_matricula', 'matriculas.id' )
        ->join( 'classe_disciplinas', 'tarefas.id_classe_disciplinas', 'classe_disciplinas.id' )
        ->join( 'classes', 'classe_disciplinas.classe_id', 'classes.id' )
        ->join( 'disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id' )
        ->select('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina',DB::raw('count(tarefas_submetidas.id) as quantidade'))
        ->groupBy('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina')
        ->get();
            
        }

        else if($it_id_classeDisciplina>0 && $it_id_anoLectivo==0)
        {
        $alunoClasse = DB::table( 'tarefas_submetidas')
        ->where([['tarefas_submetidas.it_estado', 1],['tarefas.id_classe_disciplinas',$it_id_classeDisciplina]])
        ->join( 'tarefas', 'tarefas_submetidas.it_id_tarefas', 'tarefas.id' )
        ->join( 'matriculas', 'tarefas_submetidas.it_id_matricula', 'matriculas.id' )
        ->join( 'classe_disciplinas', 'tarefas.id_classe_disciplinas', 'classe_disciplinas.id' )
        ->join( 'classes', 'classe_disciplinas.classe_id', 'classes.id' )
        ->join( 'disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id' )
        ->select('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina',DB::raw('count(tarefas_submetidas.id) as quantidade'))
        ->groupBy('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina')
        ->get();
            
        }

        else
        {
            $alunoClasse = DB::table( 'tarefas_submetidas')
        ->where([['tarefas_submetidas.it_estado', 1],['tarefas.id_classe_disciplinas',$it_id_classeDisciplina],['matriculas.it_id_anolectivo',$it_id_anoLectivo]])
        ->join( 'tarefas', 'tarefas_submetidas.it_id_tarefas', 'tarefas.id' )
        ->join( 'matriculas', 'tarefas_submetidas.it_id_matricula', 'matriculas.id' )
        ->join( 'classe_disciplinas', 'tarefas.id_classe_disciplinas', 'classe_disciplinas.id' )
        ->join( 'classes', 'classe_disciplinas.classe_id', 'classes.id' )
        ->join( 'disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id' )
        ->select('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina',DB::raw('count(tarefas_submetidas.id) as quantidade'))
        ->groupBy('tarefas.vc_tarefa','classes.vc_classe','disciplinas.vc_disciplina')
        ->get();
        }
        
        return $alunoClasse;
         
        }
    

}
