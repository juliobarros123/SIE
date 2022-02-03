<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\HorarioDeEstudo;
use Illuminate\Support\Facades\DB;
class HorarioBasicoController extends Controller
{
    public function index(Request $id)
    {
        $horario = DB::table('horario_de_estudos')
        ->where("vc_nivel","Ensino Primario")
        ->limit(1)->get();
        $uri = $id->id;
        $ativo = "active";
        return view('site.horarios-basico.index', compact('uri', 'ativo'),compact('horario'));
    }
}
