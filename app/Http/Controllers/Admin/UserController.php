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

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\Cabecalho;
use App\Models\Logger;
use App\Models\User;
use App\Repositories\Eloquent\UtilizadorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SlugController;

class UserController extends Controller
{
    use PasswordValidationRules;
    private $Logger;
    protected $user;
    public function __construct(UtilizadorRepository $user,SlugController $slug_controller)
    {
        $this->user = $user;
        $this->slug_controller = $slug_controller;
  
        $this->Logger = new Logger();
    }

    public function loggerData($mensagem)
    {
        $dados_Auth = Auth::user()->vc_primemiroNome . ' ' . Auth::user()->vc_apelido . ' Com o nivel de ' . Auth::user()->tipoUtilizador . ' ';
        $this->Logger->Log('info', $dados_Auth . $mensagem);
    }
    public function ajaxpost(Request $request)
    {
        return response()->json($request);
    }

    public function index()
    {
        $this->loggerData("Listou os usuarios");

        $utilizadores = User::all();
        return view('admin.users.index', compact('utilizadores'));
    }

    public function imprimir_lista()
    {
        $data['cabecalho'] = Cabecalho::find(1);
        $data["bootstrap"] = file_get_contents("css/listas/bootstrap.min.css");
        $data["css"] = file_get_contents("css/listas/style.css");

        $mpdf = new \Mpdf\Mpdf();

        $mpdf->SetFont("arial");
        $mpdf->setHeader();
        $this->loggerData("Imprimiu Lita de Utilizador");
        $html = view("admin/pdfs/listas/funcionario/index", $data);
        $mpdf->writeHTML($html);
        $mpdf->Output("listasdFuncionarios.pdf", "I");
    }

    public function create()
    {
        return view('admin.users.cadastrar.index');
    }

    public function salvar(Request $request)
    {
        try {

            $slug = $this->slug_controller->gerar();
            dd( $slug);
            $dados = $request->all();
            // Validator::make($dados, [
            //     'vc_nomeUtilizador' => ['required', 'string', 'max:255'],
            //     'vc_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => $this->passwordRules(),
            // ])->validate();
            $user = $this->user->store($dados);
            // $this->loggerData("Adicionou Utilizador ");
            // return redirect()->back()->with('status', '1');

            return response()->json($user);

        } catch (\Exception $exception) {
            return response()->json($exception);
            return redirect()->back()->with('aviso', '1');
        }
    }
    public function editar($slug)
    {

        if ($user = User::where([['slug', $slug]])->first()):

            return view('admin.users.editar.index', compact('user'));
        else:
            return redirect('admin/users/cadastrar')->with('teste', '1');

        endif;
    }
public function atualizar2($id,$campo,$valor){

try {
 $estado=   User::find($id)->update([
               ''.$campo=>$valor
    ]);
    return  response()->json(['estado'=>$estado,'valor'=>$valor]);
    
} catch (\Exception $exception) {
    return response()->json($exception->getMessage());
    // return redirect()->back()->with('aviso', '1');
}
}
    public function atualizar(Request $input, $slug)
    {
  
        try {
            $dados = $input->all();
           $estado= $this->user->update($dados, $slug);
        
           if($estado){
         return redirect()->route('admin.utilizadores')->with('update', '1');
           }
            
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage());
            // return redirect()->back()->with('aviso', '1');
        }
    }

    public function eliminar($slug)
    {
    
        //User::find($id)->delete();
        $user =$response= User::where('slug',$slug)->first();
        $response->delete();
        $this->loggerData("Eliminou Utilizador ".$user->primeiro_nome.' '.$user->ultimo_primeiro);
        return redirect()->route('admin.utilizadores')->with('delete', '1');
    }
    public function editar_nivel($id, $nivel)
    {
        $user = User::find($id)->update(['tipoUtilizador' => $nivel]);
        return response()->json($user);
    }
}
