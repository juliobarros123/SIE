<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Eloquent\Servico\ServicoRepository;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
use App\Models\Servico;

class ServicoController extends Controller
{
    //
    private $Logger;
    protected $servico;
  
    public function __construct(ServicoRepository $servico)
    {
       $this->servico = $servico;

  
        $this->Logger = new Logger();
    }

    public function  index(){
        $dados['empresas'] = Empresa::where('propreitario', Auth::id())->orderBy('id', 'desc')->get();
        $dados['servicos']=  $this->servico->all()->where('propreitario', Auth::id())->get();
     return view('admin.servico.index', $dados);
 
    }
    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function notificacaoInsert($notificacao,$tipo,$url)
    {
  
    
        $this->notificacao->salvar($notificacao,$tipo,$url,Auth::user()->id,null );
           
    }
    public function cadastrar(request $request)
    {


        try {
  
            $vaga =$this->servico->salvar($request->all());
            $this->loggerData("Adicionou um servico");
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
        $dados['empresas'] = Empresa::where('propreitario', $user)->orderBy('id', 'desc')->get();
  

        return view('admin.servico.cadastrar.index', $dados);
    }

    public function editar($slug)
    {
     
        $response['empresas']=Empresa::where('propreitario',Auth::User()->id)->get();
        $response['servico']=  $this->servico->all()->where('servicos.slug',$slug)->first();

        return view('admin.servico.editar.index', $response);
    }
    public function eliminar($slug)
    {
  
      
        $servico= Servico::where('slug',$slug)->first();
        $this->servico->eliminar($slug);
    
        $this->loggerData("Eliminou serviço ". $servico->servico);
        return redirect()->route('admin.servicos')->with('delete', '1');
    }

    public function actualizar(Request $input, $slug)
    {

        try {
    // dd($input->all());
           $estado=$this->servico->update($input->except(['_method',"_token"]), $slug);

           if($estado){
         return redirect()->route('admin.servicos')->with('update', '1');
           }
            
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            // return response()->json($exception->getMessage());
            // return redirect()->back()->with('aviso', '1');
        }
    }
}
