<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\Empresa;
use App\Models\User;
use App\Models\Vaga;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
use Exception;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Eloquent\Notificacao\NotificacaoRepository;

class CandidatoController extends Controller
{
    //
    protected $vaga;
  
    protected $candidato;
    protected $notificacao;

    public function __construct(CandidatoRepository $candidato,VagaRepository $vaga,NotificacaoRepository $notificacao)
    {
        $this->candidato = $candidato;
        $this->vaga = $vaga;
        $this->notificacao= $notificacao;
    }
    public function index($slug_vaga)
    {
        
        $response['vaga'] = $this->vaga->vagasMinhasEmpresas(Auth::User()->id)->where('vagas.slug',$slug_vaga)
        ->first();
     
        $response['candidatos'] = $this->candidato->all()->where('vagas.slug', $slug_vaga)->get();
        
        return view('admin.candidatos.index', $response);
    }

    public function aprovar($slug_candidato)
    {

        $estado = Candidato::where('slug', $slug_candidato)->update([
            'estado' => 2,
        ]);
        if ($estado) {
        
            $candidato = Candidato::where('slug', $slug_candidato)->first();
     
         
            $dados['user'] = $user = User::find($candidato->id_canditado);
            $dados['vaga'] = Vaga::find($candidato->id_vaga);
            $dados['empresa'] = Empresa::find($dados['vaga']->id_empresa);
            //    $dados['assunto']="Você foi aprovado";
            $url='/vagas/candidatos/minhas-vagas/'.$dados['user'] ->slug;
      
            $this->notificacao->notificacaoInsert('A empresa <strong>'.$dados['empresa']->nome.'</strong> aceitou você para uma intrevista de emprego como <strong>'. $dados['vaga']->funcao.'</strong>','CandidatoAceite',$url,Auth::User()->id,$candidato->id_canditado);
            // $this->enviarEmail($user->email, $dados, 'emails.candidato.aprovado.index');
            return redirect()->back()->with('aprovado', 1);
        }

    }

    public function reprovar($slug_candidato)
    {

        $estado = Candidato::where('slug', $slug_candidato)->update([
            'estado' => 1,
        ]);
        $candidato = Candidato::where('slug', $slug_candidato)->first();
        $dados['user'] = $user = User::find($candidato->id_canditado);
        $dados['vaga'] = Vaga::find($candidato->id_vaga);
        $dados['empresa'] = Empresa::find($dados['vaga']->id_empresa);
        //    $dados['assunto']="Você foi aprovado";
        $url='/vagas/candidatos/minhas-vagas/'.$dados['user'] ->slug;
        $this->notificacao->notificacaoInsert('A empresa <strong>'.$dados['empresa']->nome.'</strong> rejeitou você para a vaga como <strong>'. $dados['vaga']->funcao.'</strong>','CandidatoAceite',$url,Auth::User()->id, $candidato->id_candidato);
        // $this->enviarEmail($user->email, $dados, 'emails.candidato.reprovado.index');
        if ($estado) {
            return redirect()->back()->with('reprovado', 1);
        }
    }
    public $email;
    public function enviarEmail($distino, $dados, $view)
    {
        try {

            $this->email = $distino;
            Mail::send($view, $dados, function ($message) {
                $message->from('vagas@itel.gov.ao', 'S.I.E');
                $message->subject('Intrevista de trabalho');
                $message->to($this->email);

            });
            return true;
        } catch (Exception $ex) {

        }
    }

    public function listaPdf($slug_vaga){
        $response['estado']="";
        $response['vaga'] = Vaga::where('slug', $slug_vaga)->first();
        $response['candidatos'] = $this->candidato->all()->where('vagas.slug', $slug_vaga)->get();
        
        $response["css"] = file_get_contents("admin/css/relatorio/candidatos-vaga/estilo.css");
  
   
     
        $mpdf = new \Mpdf\Mpdf();
        $html = view("admin/candidatos/pdf/candidatos-vagas/index",$response);
        $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

       //  $html = view("admin/pdfs/alunos_municipio/index", $response);
       //  $mpdf->writeHTML($html);
        $mpdf->Output("alunos por municípios.pdf", "I");
 
    }
    public function listaPdfaprovados($slug_vaga){
        $response['estado']="aprovados";
        $response['vaga'] = Vaga::where('slug', $slug_vaga)->first();
        $response['candidatos'] = $this->candidato->all()->where('vagas.slug', $slug_vaga)->where('candidatos.estado',2)->get();
        
        $response["css"] = file_get_contents("admin/css/relatorio/candidatos-vaga/estilo.css");
  
   
     
        $mpdf = new \Mpdf\Mpdf();
        $html = view("admin/candidatos/pdf/candidatos-vagas/index",$response);
        $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

       //  $html = view("admin/pdfs/alunos_municipio/index", $response);
       //  $mpdf->writeHTML($html);
        $mpdf->Output("alunos por municípios.pdf", "I");
    }
    public function listaPdfNaoAprovados($slug_vaga){
        $response['estado']="não aprovados";
        $response['vaga'] = Vaga::where('slug', $slug_vaga)->first();
        $response['candidatos'] = $this->candidato->all()->where('vagas.slug', $slug_vaga)->where('candidatos.estado',1)->get();
        
        $response["css"] = file_get_contents("admin/css/relatorio/candidatos-vaga/estilo.css");
  
   
     
        $mpdf = new \Mpdf\Mpdf();
        $html = view("admin/candidatos/pdf/candidatos-vagas/index",$response);
        $mpdf->WriteHTML($response["css"] , \Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

       //  $html = view("admin/pdfs/alunos_municipio/index", $response);
       //  $mpdf->writeHTML($html);
        $mpdf->Output("alunos por municípios.pdf", "I");
    }
}
