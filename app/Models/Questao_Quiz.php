<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
class Questao_Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=[
        'questao',
        'id_nivel',
        'id_categoria',
        'id_classe_disciplina',
        'slug',
        'time'
    ];

    public function dados(){
      return  DB::table( 'questao__quizzes')
        ->join( 'nivel__quizzes', 'nivel__quizzes.id', 'questao__quizzes.id_nivel' )
        ->join( 'categoria__quizzes', 'categoria__quizzes.id', 'questao__quizzes.id_categoria' )
        ->join( 'classe_disciplinas', 'classe_disciplinas.id', 'questao__quizzes.id_classe_disciplina' )
        ->join( 'classes', 'classe_disciplinas.classe_id', 'classes.id' )
        ->join( 'disciplinas', 'classe_disciplinas.disciplina_id', 'disciplinas.id' );
    
    }

   
}
