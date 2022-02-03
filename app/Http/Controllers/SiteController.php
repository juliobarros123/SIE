<?php
/* Este sistema esta protegido pelos direitos autoriais do Instituto de Telecomunicações criado ao
 abrigo do decreto executivo conjunto nº29/85 de 29 de Abril,
 dos Ministérios da Educação e dos Transportes e Comunicações,
publicado no Diário da República, 1ª série nº 35/85, nos termos
 do artigo 62º da Lei Constitucional.

contactos:
site:www.itel.gov.ao
Telefone I: +244 931 313 333
Telefone II: +244 997 788 768
Telefone III: +244 222 381 640
Email I: secretariaitel@hotmail.com
Email II: geral@itel.gov.ao*/

namespace App\Http\Controllers;

use App\Models\Cabecalho;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClasseDisciplina;
class SiteController extends Controller
{
    //
    public function index(ClasseDisciplina $data)
    {
        $response['cds'] = $data->classes_disciplinas()->get();
        $response['cabecalho'] = Cabecalho::find(1);
        $response['uri'] = 'ops';
      
        if (Auth::id()) {
            return redirect()->route('home');
        }else{
          
            return view('site.homepage_1');
        }
    }

}