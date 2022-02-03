<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HorarioController extends Controller
{
    public function index()
    {
        return view('site.horarios.index');
    }
    public function verBascio(Request $id)
    {
        $horario = DB::table('horario_de_estudos')
            ->where("vc_nivel", "Ensino Primario")
            ->limit(1)->get();
        $uri = $id->id;
        $ativo = "active";
        return view('site.horarios-basico.index', compact('uri', 'ativo'), compact('horario'));
    }
    public function verSecundario(Request $id)
    {
        $horario = DB::table('horario_de_estudos')
            ->where("vc_nivel", "Iº Ciclo do Secundario")
            ->limit(1)->get();
        //
        $uri = $id->id;
        $ativo = "active";


        return view('site.horarios-secundario.index', compact('uri', 'ativo'), compact('horario'));
    }
}