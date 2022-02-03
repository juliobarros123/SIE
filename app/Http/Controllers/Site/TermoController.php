<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Termo;
class TermoController extends Controller
{
    //
    public function index(){
      $termo=  Termo::where('tipoUtilizador','Encarregado')->latest()->first();
      return view('site.termos.index',compact('termo'));
    }
}
