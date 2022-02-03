<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClasseDisciplina extends Model
{
    use HasFactory;
    protected $fillable = [
        'classe_id',
        'disciplina_id',
        'it_estado'
    ];

    public function classes_disciplinas()
    {
        $classes_disciplinas = DB::table('classe_disciplinas')
            ->join('classes', 'classe_disciplinas.classe_id', '=', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', '=', 'disciplinas.id')
            ->where([['classes.it_estado',1]])
            ->where([['classe_disciplinas.it_estado', 1]])
            ->where([['disciplinas.it_estado', 1]])
            ->select(
                'classes.vc_classe',
                'disciplinas.vc_disciplina',
                'classe_disciplinas.disciplina_id',
                'classe_disciplinas.classe_id',
                'disciplinas.vc_imagem',
                'classe_disciplinas.id'
            );

        return $classes_disciplinas;
    }
}
