<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioSecundarioController extends Controller
{
    public function index(Request $id)
    {
         $horario = DB::table('horario_de_estudos')
        ->where("vc_nivel","Iº Ciclo do Secundario")
        ->limit(1)->get();
        //
        $uri = $id->id;
        $ativo = "active";


       return view('site.horarios-secundario.index', compact('uri', 'ativo'),compact('horario'));
    }
}
