<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ClasseDisciplina;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(ClasseDisciplina $data)
    {
    
 
        $response['cds'] = $data->classes_disciplinas()->get();
   
        $response['uri'] = 'ops';
        return view('site.index', $response);
    }
}