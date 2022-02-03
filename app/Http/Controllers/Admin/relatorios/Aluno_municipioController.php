<?php

namespace App\Http\Controllers\Admin\relatorios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnoLectivo;
use App\Models\Escola;
use App\Models\Cabecalho;
use Illuminate\Support\Facades\DB;

class Aluno_municipioController extends Controller
{
   
    public function pesquisar()
    {
        $response['anoslectivos'] = AnoLectivo::all();
        $response['municipios'] = DB::table('matriculas')
        ->join('escolas','escolas.id','matriculas.it_id_escola')
        ->select('escolas.it_id_minicipio')->distinct('escolas.it_id_minicipio')
        ->get();
        return view('admin/relatorios/Aluno/index', $response);
    }

    public function recebeMunicipio(Request $request)
    {
        $anoLectivo = $request->vc_anolectivo;
        $municipio = $request->vc_municipio;

        return redirect("admin/alunos/visualizar/index/$anoLectivo/$municipio");
    }
    
    public function visualizar(Escola $escola ,$anoLectivo,$municipio)
  {
   $teste = $escola->Municipio($anoLectivo,$municipio);
   $response['totalGeral']= $teste;
   $response['data'] = $anoLectivo;
   $response['data1'] = $municipio;
   return view('admin/relatorios/Aluno/view/index',$response);
   
  }
    
public function pdfAlunos(Escola $escola ,$anoLectivo,$municipio)
{
    
    $response['cabecalho'] = Cabecalho::first();
    $teste = $escola->Municipio($anoLectivo,$municipio);
    $response["css"] = file_get_contents("css/Alunos_municipio/bootstrap.min.css");
    //$response["css"] = file_get_contents("css/Alunos_municipio/style.css");
 
       
         $response['titulo'] = "Estatística de alunos por escola";
         $response['data'] = $anoLectivo;
          
         $response['data1'] = $municipio;
       
        if(isset($teste['0'])){
         $response['totalGeral']= $teste;
         $response['totalGeral2']= $teste['0'];
         $mpdf = new \Mpdf\Mpdf();

         $html = view("admin/pdfs/alunos_municipio/index",$response);
         $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
         $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        //  $html = view("admin/pdfs/alunos_municipio/index", $response);
        //  $mpdf->writeHTML($html);
         $mpdf->Output("alunos por municípios.pdf", "I");
        }


        else{
            
            return redirect()->route( 'admin.alunos.pesquisar.index')->with('error',1);
        }

}

}
