<?php

namespace App\Http\Controllers\Admin\relatorios;

use App\Http\Controllers\Controller;
use App\Models\AnoLectivo;
use App\Models\Escola;
use App\Models\User;
use App\Models\Cabecalho;
use App\Models\Estatistica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Matricula;
use App\Models\Logger;

class RelatorioAlunoController extends Controller
{
    protected $matricula, $classe;
   
    public function __construct(Matricula $matricula)
    {
        $this->matricula=$matricula;
        $this->Logger = new Logger();
      
    }


    public function listarAlunoClasse(Request $r){
        $cabecalho=Cabecalho::find(1);
        $it_id_anoLectivo=$r->it_id_anoLectivo;
        $it_id_anoLectivoLista=$it_id_anoLectivo;
        $it_id_escola=$r->it_id_escola;
        $it_id_escolaLista=$it_id_escola;

        $classes= $this->matricula->alunosClasse($it_id_anoLectivo,$it_id_escola);

        if($it_id_anoLectivo==0)
            $it_id_anoLectivoLista=AnoLectivo::min('ya_inicio').'-'.AnoLectivo::min('ya_fim').' à '.AnoLectivo::max('ya_inicio').'-'.AnoLectivo::max('ya_fim');
        else{
            $it_id_anoLectivoLista=AnoLectivo::find($it_id_anoLectivo);
            $it_id_anoLectivoLista=$it_id_anoLectivoLista->ya_inicio.'-'.$it_id_anoLectivoLista->ya_fim;
            }
        
        if($it_id_escola==0)
            $it_id_escolaLista="XILONGA (todas as escolas do sistema)";
        else{
            $it_id_escolaLista=Escola::find($it_id_escola);
            $it_id_escolaLista=$it_id_escolaLista->vc_escola;
        }
        //dd($it_id_escolaLista);

    return redirect()->route('listar_alunos_classe2',[$it_id_anoLectivo,$it_id_escola,$cabecalho,$it_id_anoLectivoLista,$it_id_escolaLista]);
        
    }

    public function listarAlunoClasse2($it_id_anoLectivo,$it_id_escola,$cabecalho,$it_id_anoLectivoLista,$it_id_escolaLista){  
        $classes= $this->matricula->alunosClasse($it_id_anoLectivo,$it_id_escola);
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['it_id_escola']=$it_id_escola;
        $dados['classes']=$classes;
        $dados['cabecalho']=$cabecalho;
        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['it_id_escolaLista']=$it_id_escolaLista;
        return view("admin.relatorios.aluno.quantidade_aluno_classe.index",$dados);
    }
     
    public function imprimirAlunoClasse($it_id_anoLectivo,$it_id_escola,$it_id_anoLectivoLista,$it_id_escolaLista){
        $cabecalho=Cabecalho::find(1);
        $classes= $this->matricula->alunosClasse($it_id_anoLectivo,$it_id_escola);

        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['it_id_escolaLista']=$it_id_escolaLista;
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['it_id_escola']=$it_id_escola;
        $dados['cabecalho']=$cabecalho;
        $dados['classes']=$classes;
        
        $css = file_get_contents("css/Alunos_municipio/bootstrap.min.css");
        
        $mpdf = new \Mpdf\Mpdf();
    
        $html = view("admin.pdfs.quantidade_aluno_classe.index",$dados);
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
      
        $mpdf->Output("matricula.pdf", "I");
      
   
    }

    public function verAlunosClasse(){
     $anoLectivos=AnoLectivo::all();
     $escolas=Escola::all();
     $it_id_escola=0;
     $it_id_anolectivo=0;
     $dados['anoLectivos']= $anoLectivos;
     $dados['escolas']= $escolas;
     $dados['it_id_escola']= $it_id_escola;
     $dados['it_id_anolectivo']= $it_id_anolectivo;
        return view('admin.relatorios.aluno.quantidade_aluno_classe.ver.index',$dados);
    }

    public function paginaRelatorioAlunoEscola(){
        $anoLectivos=AnoLectivo::all();
        $escolas=Escola::all();
        $it_id_escola=0;
        $it_id_anolectivo=0;
        $dados['anoLectivos']= $anoLectivos;
        $dados['escolas']= $escolas;
        $dados['it_id_escola']= $it_id_escola;
        $dados['it_id_anolectivo']= $it_id_anolectivo;
           return view('admin.relatorios.aluno.quantidade_aluno_escola.ver.index',$dados);
      
   
    }

    public function listarAlunoEscola(Request $r){
     
        $cabecalho=Cabecalho::find(1);
        $it_id_anoLectivo=$r->it_id_anoLectivo;
        $it_id_anoLectivoLista=$it_id_anoLectivo;
        $it_id_escola=$r->it_id_escola;
        $it_id_escolaLista=$it_id_escola;

    $escola= $this->matricula->alunoPorEscola($it_id_anoLectivo,$it_id_escola);
    //dd($escola);
        if($it_id_anoLectivo==0)
            $it_id_anoLectivoLista=AnoLectivo::min('ya_inicio').'-'.AnoLectivo::min('ya_fim').' à '.AnoLectivo::max('ya_inicio').'-'.AnoLectivo::max('ya_fim');
        else{
            $it_id_anoLectivoLista=AnoLectivo::find($it_id_anoLectivo);
            $it_id_anoLectivoLista=$it_id_anoLectivoLista->ya_inicio.'-'.$it_id_anoLectivoLista->ya_fim;
            }
        
        if($it_id_escola==0)
            $it_id_escolaLista="XILONGA (todas as escolas do sistema)";
        else{
            $it_id_escolaLista=Escola::find($it_id_escola);
            $it_id_escolaLista=$it_id_escolaLista->vc_escola;
        }

    return redirect()->route('listar_alunos_escola2',[$it_id_anoLectivo,$it_id_escola,$cabecalho,$it_id_anoLectivoLista,$it_id_escolaLista]);
   
    }

    public function listarAlunoEscola2($it_id_anoLectivo,$it_id_escola,$cabecalho,$it_id_anoLectivoLista,$it_id_escolaLista){
     
        $escolas= $this->matricula->alunoPorEscola($it_id_anoLectivo,$it_id_escola);
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['it_id_escola']=$it_id_escola;
        $dados['escolas']=$escolas;
        $dados['cabecalho']=$cabecalho;
        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['it_id_escolaLista']=$it_id_escolaLista;
        $dados['nao_matriculados']=$this->alunosSemEscola($it_id_anoLectivo);
        //$escolass=$this->alunosSemEscola($it_id_anoLectivoLista);
        //dd($escolas);
        return view("admin.relatorios.aluno.quantidade_aluno_escola.index",$dados);
   
    }



    public function imprimirAlunoEscola($it_id_anoLectivo,$it_id_escola,$it_id_anoLectivoLista,$it_id_escolaLista){
     
        $cabecalho=Cabecalho::find(1);
        $escolas= $this->matricula->alunoPorEscola($it_id_anoLectivo,$it_id_escola);

        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['it_id_escolaLista']=$it_id_escolaLista;
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['it_id_escola']=$it_id_escola;
        $dados['cabecalho']=$cabecalho;
        $dados['escolas']=$escolas;
        $dados['nao_matriculados']=$this->alunosSemEscola($it_id_anoLectivo);
        
        $css = file_get_contents("css/Alunos_municipio/bootstrap.min.css");
        
        $mpdf = new \Mpdf\Mpdf();
    
        $html = view("admin.pdfs.quantidade_aluno_escola.index",$dados);
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
      
        $mpdf->Output("matricula.pdf", "I");
   
    }

    public function alunosSemEscola($it_id_anolectivo){
        $alunos=User::where('tipoUtilizador','Filho')->get();
        $aluno_cadastrado=0;
        $aluno_matriculado=0;
        if($it_id_anolectivo==0)
            {
                $matriculas=Matricula::all();
            }
        else
            {
                $matriculas=Matricula::where('it_id_anolectivo',$it_id_anolectivo)->get();
            }
        

        foreach($alunos as $aluno){

            $aluno_cadastrado++;
            foreach($matriculas as $matricula){
                if($aluno->id==$matricula->it_id_utilizador)
                 $aluno_matriculado++;
            }
        }
        return $aluno_cadastrado-$aluno_matriculado;
    }

    public function paginaRelatorioAlunoProvincia(){
        $anoLectivos=AnoLectivo::all();
        $it_id_anolectivo=0;
        $dados['anoLectivos']= $anoLectivos;
        $dados['it_id_anolectivo']= $it_id_anolectivo;
        return view('admin.relatorios.aluno.quantidade_aluno_provincia.ver.index',$dados);
      
   
    }

    public function listarAlunoProvincia(Request $r){
     
        $cabecalho=Cabecalho::find(1);
        $it_id_anoLectivo=$r->it_id_anoLectivo;
        $it_id_anoLectivoLista=$it_id_anoLectivo;

   // $provincia= $this->matricula->alunoPorEscola($it_id_anoLectivo,$it_id_escola);
    //dd($escola);
        if($it_id_anoLectivo==0)
            $it_id_anoLectivoLista=AnoLectivo::min('ya_inicio').'-'.AnoLectivo::min('ya_fim').' à '.AnoLectivo::max('ya_inicio').'-'.AnoLectivo::max('ya_fim');
        else{
            $it_id_anoLectivoLista=AnoLectivo::find($it_id_anoLectivo);
            $it_id_anoLectivoLista=$it_id_anoLectivoLista->ya_inicio.'-'.$it_id_anoLectivoLista->ya_fim;
            }

    return redirect()->route('listar_alunos_provincia2',[$it_id_anoLectivo,$it_id_anoLectivoLista]);
   
    }

    public function listarAlunoProvincia2($it_id_anoLectivo,$it_id_anoLectivoLista){
     
        $cabecalho=Cabecalho::find(1);
        $total=0;
        $provincias= $this->matricula->alunosPorProvincia($it_id_anoLectivo);
        foreach($provincias as $provincia){
            $total+=$provincia->quantidade;
        }
        //dd($escolas);
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['cabecalho']=$cabecalho;
        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['provincias']=$provincias;
        $dados['total']=$total;
        //$escolass=$this->alunosSemEscola($it_id_anoLectivoLista);
        //dd($escolas);
        return view("admin.relatorios.aluno.quantidade_aluno_provincia.index",$dados);
   
    }

    public function imprimirAlunoProvincia($it_id_anoLectivo,$it_id_anoLectivoLista){
     
        $cabecalho=Cabecalho::find(1);
        $provincias= $this->matricula->alunosPorProvincia($it_id_anoLectivo);
        $total=0;
        foreach($provincias as $provincia){
            $total+=$provincia->quantidade;
        }

        $dados['it_id_anoLectivoLista']=$it_id_anoLectivoLista;
        $dados['it_id_anoLectivo']=$it_id_anoLectivo;
        $dados['cabecalho']=$cabecalho;
        $dados['provincias']=$provincias;
        $dados['total']=$total;
        $dados['nao_matriculados']=$this->alunosSemEscola($it_id_anoLectivo);
        
        $css = file_get_contents("css/Alunos_municipio/bootstrap.min.css");
        
        $mpdf = new \Mpdf\Mpdf();
    
        $html = view("admin.pdfs.quantidade_aluno_provincia.index",$dados);
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
      
        $mpdf->Output("matricula.pdf", "I");
   
    }

}
