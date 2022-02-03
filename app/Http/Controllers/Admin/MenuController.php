<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public $userId;
    public function  listarPorId()
    {
        $this->userId = Auth::id();




        $disciplinas2 = DB::table('matriculas')
            ->join('classes', 'classes.id', '=', 'matriculas.it_id_classe')
            ->join('classe_disciplinas', 'classe_disciplinas.classe_id', '=', 'classes.id')
            ->join('disciplinas', 'classe_disciplinas.disciplina_id', '=', 'disciplinas.id')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'matriculas.it_id_utilizador')

                    ->where('users.id', '=', $this->userId);
            })
            ->select('users.*', 'disciplinas.*','disciplinas.id as id_disciplina', 'classe_disciplinas.id as id_classe_disciplinas','matriculas.id as id_matricula')
            ->get();


        return $disciplinas2;
    }
}