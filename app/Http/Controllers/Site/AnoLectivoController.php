<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnoLectivoController extends Controller
{
    public function index(Request $id)
    {
        $uri = $id->id;
        $ativo = "active";
        return view('site.anos-lectivo.index', compact('uri', 'ativo'));
    }
}