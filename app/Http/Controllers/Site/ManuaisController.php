<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
class ManuaisController extends Controller
{
    public function index(Request $id)
    {
        $uri = $id->id;
        $ativo = "active";
        $response['classes'] = Classe::where([['it_estado',1]])->orderBy('vc_classe', 'asc')->get();
        // $response['disciplinas'] = $data->classes_disciplinas()->get();
        return view('site.manuais.index', compact('uri', 'ativo'), $response);
    }
}