<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Empresa;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use App\Repositories\Eloquent\Notificacao\NotificacaoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
class VagaController extends Controller
{
    //

    private $Logger;
    protected $vaga;
    protected $notificacao;
    public function __construct(VagaRepository $vaga,NotificacaoRepository $notificacao)
    {
        $this->vaga = $vaga;
        $this->notificacao= $notificacao;
  
        $this->Logger = new Logger();
    }

    public function  index(){
        $vagas=   $this->vaga->vagasMinhasEmpresas(Auth::User()->id)->get();


     $empresas=Empresa::where('propreitario',Auth::User()->id)->get();

     return view('admin.vaga.index', compact('vagas'),compact('empresas'));
 
    }
    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function notificacaoInsert($notificacao,$tipo,$url)
    {
  ;
    
        $this->notificacao->salvar($notificacao,$tipo,$url,Auth::user()->id,null );
           
    }
    public function cadastrar(request $request)
    {


        try {
            $empresa= Empresa::find($request->id_empresa);
            $vaga =$this->vaga->salvar($request, Auth::user()->id);
            $this->loggerData("Adicionou uma vaga");
            $this->notificacaoInsert('A empresa <strong>'.$empresa->nome.'</strong> disponibilizou nova vaga','nova_vaga','vagas');
           
            return redirect()->back()->with('status', '1');
        } catch (\Throwable $th) {
       dd($th);
            return redirect()->back()
                ->with('status', 0)
                ->with('message', 'Vaga')
                ->with('opcao', 0);
        }
    }

    public function criar()
    {
        $user = Auth::id();
        $dados['empresas'] = Empresa::where('id_empresario', $user)->orderBy('id', 'desc')->get();
        $dados["vagas"] = Vaga::get();
        $dados['areas'] =  Area::get();
        $dados['funcoes'] =  Funcao::get();

        return view('admin.vaga.cadastrar.index', $dados);
    }

    public function editar($slug)
    {
    
        $response['vaga'] =$response=  $this->vaga->vagasMinhasEmpresas(Auth::User()->id)->where('vagas.slug',$slug)
       ->first();
        // dd( $response['vaga']);
        $response['empresas']=Empresa::where('propreitario',Auth::User()->id)->get();
      

        return view('admin.vaga.editar.index', $response);
    }
    public function eliminar($slug)
    {
  
        //User::find($id)->delete();
        $vaga =$response= Vaga::where('slug',$slug);
        
        $vaga=$vaga->first();
  
        $response->delete();
      
        $this->loggerData("Eliminou vaga ".$vaga->funcao);
        return redirect()->route('admin.vagas')->with('delete', '1');
    }

    public function actualizar(Request $input, $slug)
    {
  
        try {
       
  
           $estado= $this->vaga->update($input, $slug);
 
           if($estado){
         return redirect()->route('admin.vagas')->with('update', '1');
           }
            
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            // return response()->json($exception->getMessage());
            // return redirect()->back()->with('aviso', '1');
        }
    }

}
