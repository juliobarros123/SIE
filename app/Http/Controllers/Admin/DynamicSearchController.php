<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Escola;
use App\Models\User;
use App\Models\Classe;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Models\Dias_semanas;
class DynamicSearchController extends Controller
{
    public function searchSchool(Request $request)
    {
        $escolas = [];
        if ($request->has('q')) {
            $buscar = $request->q;
            $escolas = Escola::select("id", "vc_escola")
                ->where('vc_escola', 'LIKE', "%$buscar%")->get();
        }

        return response()->json($escolas);
    }

    public function searchGradeSubject(Request $request)
    {
        $classesEscolas = [];
        if ($request->has('q')) {
            $buscar = $request->q;
            $classesEscolas = Escola::select("id", "vc_escola")
            ->where('vc_escola', 'LIKE', "%$buscar%")->get();
        }else{

            $classesEscolas = DB::select('select * from escolas');
        }

        return response()->json($classesEscolas);
    }

    public function searchGrade(Request $request)
    {
        $classes = [];
        if ($request->has('q')) {
            $buscar = $request->q;
            $classes = Classe::select("id", "vc_classe")
                ->where('vc_classe', 'LIKE', "%$buscar%")->get();
        }else{

            $classes = DB::select('select * from classes');
        }

        return response()->json($classes);
    }

    public function searchDaysOfTheWeek(Request $request)
    {
        $diasSemana = [];
        if ($request->has('q')) {
            $buscar = $request->q;
            $diasSemana = Dias_semanas::select("id", "vc_dia")
            ->where('vc_dia', 'LIKE', "%$buscar%")->get();
        }else{

            $diasSemana = DB::select('select * from dias_semanas ');
        }

        return response()->json($diasSemana);
    }


    public function searchYear(Request $request)
    {
        $anoslectivos = [];
        if ($request->has('q')) {
            $buscar = $request->q;
            $anoslectivos = AnoLectivo::select("id", "ya_inicio", "ya_fim")
                ->where('ya_fim', 'LIKE', "%$buscar%")->get();
        }else{

            $anoslectivos = DB::select('select * from anoslectivos ');
        }

        return response()->json($anoslectivos);
    }
}
