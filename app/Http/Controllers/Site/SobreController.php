<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SobreController extends Controller
{
    public function index(Request $id)
    {
        $uri = $id->id ? $id->id : ['ops'];
        $ativo = "active";
        return view('site.sobre.index', compact('uri', 'ativo', 'ativo'));
    }
}