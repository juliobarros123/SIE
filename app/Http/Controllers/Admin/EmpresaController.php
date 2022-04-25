<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Repositories\Eloquent\Empresa\EmpresaRepository;
use App\Models\Logger;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class EmpresaController extends Controller
{
    protected $empresa;
    public function __construct(EmpresaRepository $empresa)
    {
        $this->empresa = $empresa;
        $this->Logger = new Logger();
    }
    //

    
    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function cadastrar(Request $request){
        try {
        
            $empresa =$this->empresa->salvar($request, Auth::user()->id);
       if(  $empresa && Auth::User()->tipoUtilizador == 'Visitante' ){
           User::find(Auth::User()->id)->update([
               'tipoUtilizador'=>'Empresario'
           ]
           );
       }

       
            $this->loggerData("Cadastrou uma nova empresa");
            return redirect()->back()->with('status', '1');

            // return response()->json($user);

        } catch (\Exception $exception) {
            return response()->json($exception);
            return redirect()->back()->with('aviso', '1');
        }
    }
    public function editar($slug){

        $empresa =$this->empresa->all()->where('empresas.slug',$slug)->first();
        return view('admin.empresa.editar.index',compact('empresa'));
    }
    public function index(){
        $empresas=array();
        if(Auth::User()->tipoUtilizador == 'Administrador'){
            $empresas=$this->empresa->all()->get();
        }else if(Auth::User()->tipoUtilizador == 'Empresario'){
            $empresas=$this->empresa->all()->where('empresas.propreitario',Auth::id())->get();
        }
   
 
     return view('admin.empresa.index', compact('empresas'));
    }


    public function atualizar(Request $input, $slug)
    {
  
        try {
       
  
           $estado= $this->empresa->update($input, $slug);
    //  dd(  $estado);
           if($estado){
            $this->loggerData("Editou uma  empresa");
            return redirect()->back()->with('status', '1');
             return redirect()->route('admin.empresas')->with('update', '1');
           }
            
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
            // return redirect()->back()->with('aviso', '1');
        }
    }
    public function eliminar($slug)
    {
    
        $empresa =$response= Empresa::where('slug',$slug)->first();
        $response->delete();
        $this->loggerData("Eliminou a empresa ".$empresa->nome);
        return redirect()->route('admin.empresas')->with('delete', '1');
    }
}
