<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Vaga;
use App\Models\Empresa;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Repositories\Eloquent\Candidato\CandidatoRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Eloquent\Notificacao\NotificacaoRepository;
class CandidatoController extends Controller
{
    //
    protected $file;
    protected $candidato;
    protected $Logger;
    protected $notificacao;

    public function __construct(FileRepository $fileVagaRepository ,CandidatoRepository $candidato,NotificacaoRepository $notificacao)
    {
        $this->candidato = $candidato;
        $this->file = $fileVagaRepository;
        $this->Logger = new Logger();
        $this->notificacao= $notificacao;
    }


    
    //

    
    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function inscrever_se($slug_vaga)
    {
        $vaga =vagas_disponiveis()->where('vagas.slug', $slug_vaga)->first();
        return view('site.candidatos.inscrever-se.index', compact('slug_vaga'),compact('vaga'));
    }
    public function inscrever_se_agora(Request $request, $slug_vaga)
    {
        try {
     
        $input = 'curriculo';
        $caminho = 'vaga/candidato/curriculos';
        $vaga = Vaga::where('slug', $slug_vaga)->first();
        $curriculo = $this->file->upload_fileArray($request, $input, $caminho);
      
        $dados['caminho_curriculo'] = $curriculo;
  
        $dados['id_vaga'] = $vaga->id;
        $dados['requisito1'] = $request->requisito1;
        $dados['requisito2'] = $request->requisito2;
        $dados['requisito3'] = $request->requisito3;
        $dados['requisito4'] = $request->requisito4;
           $this->candidato->salvar( $dados,Auth::Id());
            // dd($vaga->id);
            $empresa=Empresa::find($vaga->id_empresa);
            $url='admin/vagas/candidatos/'.$vaga->slug;
            $this->notificacao->notificacaoInsert('<strong>'.Auth::User()->primeiro_nome.' '.Auth::User()->ultimo_nome.'</strong> inscreveu-se na vaga <strong>'. $vaga->funcao.'</strong>','InscricaoVaga',$url,Auth::User()->id, $empresa->propreitario);
            $this->loggerData("Inscreveu-se na vaga ".$vaga->funcao. ' da empresa');
            return redirect()->back()->with('inscrito', '1');
        } catch (\Throwable $th) {
       dd( $th);
            return redirect()->back()
                ->with('erro', 1);
        }

    }

    public function minhas_vagas($slug_candidato){
        $vagas =$this->candidato->minhas_vagas($slug_candidato)->get();
        // dd( $vagas);
        return view('site.candidatos.minhas-vagas.index', compact('vagas'));
    }
    public function sair($slug_vaga){
        
        $vagas =$this->candidato->minhas_vagas(Auth::User()->slug)->where('vagas.slug',$slug_vaga)->delete();
        return redirect()->back()->with('vaga_sair', '1');
   
    }
}
