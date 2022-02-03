<?php

namespace App\Http\Controllers\Admin\relatorios;

use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Escola;
use App\Models\Cabecalho;
use App\Models\Estatistica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TarefasSubmetidas;
use App\Models\Logger;

class TarefasSubmetidasController extends Controller
{
    protected $tarefasSubmetidas;

    public function __construct(TarefasSubmetidas $tarefasSubmetidas)
    {
        $this->tarefasSubmetidas=$tarefasSubmetidas;
        $this->Logger = new Logger();
      
    }

         
    public function listarTarefasSubmetidas(Request $r){
        $cabecalho=Cabecalho::find(1);
        $it_id_anoLectivo=$r->it_id_anoLectivo;
        $it_id_classesDiciplina=$r->it_id_classesDiciplina;

        $it_id_anoLectivoLista=$it_id_anoLectivo;
        $it_id_classesDiciplinaLista=$it_id_classesDiciplina;
     
        
        if($it_id_anoLectivo==0)
            $it_id_anoLectivoLista=AnoLectivo::min('ya_inicio').'-'.AnoLectivo::min('ya_fim').' à '.AnoLectivo::max('ya_inicio').'-'.AnoLectivo::max('ya_fim');
        else{
            $it_id_anoLectivoLista=AnoLectivo::find($it_id_anoLectivo);
            $it_id_anoLectivoLista=$it_id_anoLectivoLista->ya_inicio.'-'.$it_id_anoLectivoLista->ya_fim;
            }
    
            return redirect()->route('listar_tarefas_submetidas2',[$cabecalho,$it_id_anoLectivo,$it_id_classesDiciplina,$it_id_anoLectivoLista]);
        
    }
     
    public function listarTarefasSubmetidas2($cabecalho,$it_id_anoLectivo,$it_id_classesDiciplina,$it_id_anoLectivoLista){
    
        $tarefas= $this->tarefasSubmetidas->tarefasSubmetidas($it_id_classesDiciplina,$it_id_anoLectivo);
    
        $dados['tarefas']=$tarefas;
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['it_id_classesDiciplina']=$it_id_classesDiciplina;
        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;

        return view("admin.relatorios.aluno.quantidade_tarefas_submetidas.index",$dados);
    }
    public function imprimirTarefasSubmetidas($it_id_anoLectivo,$it_id_classesDisciplina,$it_id_anoLectivoTexto){
        $cabecalho=Cabecalho::find(1);
        
        $tarefas= $this->tarefasSubmetidas->tarefasSubmetidas($it_id_classesDisciplina,$it_id_anoLectivo);


        $dados['tarefas']=$tarefas;
        $dados['cabecalho']=$cabecalho;
        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoTexto;


        
        $css = file_get_contents("css/Alunos_municipio/bootstrap.min.css");
        
        $mpdf = new \Mpdf\Mpdf();

        $html = view("admin.pdfs.quantidade_tarefas_submetidas.index",$dados);
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

        $mpdf->Output("TarefasSubmetidas.pdf", "I");
      
   
    }

    public function quantidadeTarefasSubmetidas(){
 
  
     $anoLectivos=AnoLectivo::all();
     $classesDisciplinas=DB::table('classe_disciplinas')
     ->join('classes', function ($join) {
         $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
     })
     ->join('disciplinas', function ($join) {
         $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
       
     })->select('classe_disciplinas.id as id_c_d','classe_disciplinas.*','disciplinas.*','classes.*')
   ->where('classe_disciplinas.it_estado','=',1) ->get();

     $it_id_classeDisciplina=0;
     $it_id_anolectivo=0;
     $dados['anoLectivos']= $anoLectivos;
     $dados['classesDisciplinas']= $classesDisciplinas;
     $dados['it_id_classeDisciplina']= $it_id_classeDisciplina;
     $dados['it_id_anolectivo']= $it_id_anolectivo;
        return view('admin.relatorios.aluno.quantidade_tarefas_submetidas.ver.index',$dados);
    }

}
