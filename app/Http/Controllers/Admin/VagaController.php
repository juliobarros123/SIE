<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;
use App\Models\Empresa;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Logger;
class VagaController extends Controller
{
    //

    private $Logger;
    protected $vaga;
    public function __construct(VagaRepository $vaga)
    {
        $this->vaga = $vaga;
    
  
        $this->Logger = new Logger();
    }

    public function  index(){
     $vagas=   Vaga::join('empresas','empresas.id','vagas.id_empresa')->select('vagas.*')->get();
     $empresas=Empresa::where('propreitario',Auth::User()->id)->get();

     return view('admin.vaga.index', compact('vagas'),compact('empresas'));
 
    }
    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function cadastrar(request $request)
    {


        try {
            $vaga =$this->vaga->salvar($request, Auth::user()->id);
            $this->loggerData("Adicionou uma vaga");
            return redirect()->back()->with('status', '1');
        } catch (\Throwable $th) {
       
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
    
        $response['vaga'] =$response= Vaga::join('empresas','vagas.id_empresa','empresas.id')->where('vagas.slug',$slug)
        ->select('vagas.*','empresas.nome','empresas.id','empresas.propreitario')->first();
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
