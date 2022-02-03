<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\ClasseDisciplina;
use Illuminate\Http\Request;

class AnoEscolaridadeController extends Controller
{
    public function index(ClasseDisciplina $data)
    {
        $response['classes'] = Classe::where([['it_estado',1]])->orderBy('vc_classe', 'asc')->get();
        $response['disciplinas'] = $data->classes_disciplinas()->get();
        return view('site.anos-escolaridade.index', $response);
    }
}
