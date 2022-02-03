<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Keygen\Keygen;
use Illuminate\Support\Str;
class SlugController extends Controller
{
    //
    
    public static function gerar()
    {
        
        $slug =Keygen::numeric(2)->generate().uniqid(date('HisYmd')). Keygen::numeric(4)->generate();
      
        return  $slug;
    }

 
}
