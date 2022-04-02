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

namespace App\Http\Controllers\Site;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Controllers\Controller;
use App\Models\TermoUtilizador;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Eloquent\UtilizadorRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\SlugController;
class UserController extends Controller
{
    use PasswordValidationRules;

    protected $user;
protected $slug_controller;
    public function __construct(UtilizadorRepository $user,SlugController $slug_controller)
    {
        $this->user = $user;
        $this->slug_controller = $slug_controller;
    }

    public function create()
    {
        $uri = 'ops';

        return view('site.encarregado.index', compact('uri'));
    }
    public function increver_se()
    {
        $uri = 'ops';

        return view('auth.registerLogin', compact('uri'));
    }
     
    public function salvar(Request $request)
    {
        // dd($request);
        try {
if($request->password==$request->password_confirm){
            // $path = Storage::putFile('userPhoto', $request->file('foto'));
            // dd( $path);
            $dados = $request->all();

            $dados['tipoUtilizador'] = 'Visitante';
            // $dados['profile_photo_path'] = $this->upload_img($request);

            // dd("oa", $dados['profile_photo_path'] );

            // dd( $dados['profile_photo_path'] );
            // Validator::make($dados, [
            //     // 'vc_nomeUtilizador' => ['required', 'string', 'max:255'],
            //     'vc_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => $this->passwordRules(),
            // ])->validate();
            // dd(     $dados);
           
            $user = $this->user->store( $dados);

            // if ($user && $dados['termo'] == 'on') {
                TermoUtilizador::create([
                    'it_id_utilizador' => $user->id,
                ]);
                event(new Registered($user));

                Auth::login($user);

                return redirect(RouteServiceProvider::HOME);
                // return redirect( 'login' )->with('encarregado', '1' );
            // } else {

            //     return redirect()->back()->with('aviso', '1');
            // }
            }else{
             return redirect()->back()->with('senha', '1');
            }
        } catch (\Exception $exception) {
dd( $exception);
            return redirect()->back()->with('error', '1');
        }

    }

    public function buscaUsuario($usuario)
    {
        // dd($usuario);
        // return "ola";
        // echo '<script>alert("Welcome to Geeks for Geeks")</script>';

        try {
        $result=User::where('vc_nomeUtilizador', $usuario)->first();

       return $result->vc_nomeUtilizador?response()->json(['user'=>$result->vc_nomeUtilizador]):response()->json(['user'=>'']);

    } catch (\Exception $exception) {

        return response()->json(['user'=>'']);
    }

        
    }
    public function upload_img(Request $request)
    {
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request->foto->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request->foto->storeAs('userPhoto', $nameFile);
//            $upload = substr($upload, 7, strlen($upload));
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload ( Redireciona de volta )
            if (!$upload) {
                return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {

                return $upload;
            }
        } else {
            return 'userPhoto/userPadrao.jpg';
        }
    }

    public function editar($id)
    {
        if (!$this->validar_autoria($id)) {

            return redirect()->back()->with('edicao_nao_autorizado', 1);
        }
        $c = User::find($id);
        if ($response['user'] = User::find($id)):
            $user = User::find($id);
            return view('site.users.editar.index', compact('user'));
        else:
            return redirect('site/users/cadastrar')->with('teste', '1');

        endif;
    }

    public function validar_autoria($id)
    {

        if ($id == Auth::user()->id) {
            return true;
        } else if (Auth::User()->tipoUtilizador == 'Administrador' || Auth::User()->tipoUtilizador == 'Desenvolvedor') {
            return true;
        } else {
            return false;
        }
    }
}
