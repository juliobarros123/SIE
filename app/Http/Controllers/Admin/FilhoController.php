<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Repositories\Eloquent\UtilizadorRepository;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Auth;
use Exeception;
use App\Http\Controllers\Admin\DireitoConteudoController;
use App\Models\Logger;

class FilhoController extends Controller
{
    //
    protected $user;
    private $Logger;
    private $direito_conteudo;
    public function __construct(UtilizadorRepository $user,DireitoConteudoController $direito_conteudo)
    {
        $this->user = $user;
        $this->Logger = new Logger();
        $this->direito_conteudo=$direito_conteudo;
    }

    public function editar($id)
    {
        if(!$this->direito_conteudo->meu_filho($id)){
            return redirect()->back()->with('acao_nao_autorizado', 1);
        }

        $user = User::find($id);
        if ($response['user'] = User::find($id)) :

            /*if ( $user->tipoUtilizador == 'Filho' ):
        return view( 'admin.users.editar.index', compact( 'user' ) );
        else:
        return view( 'admin.users.editar.index', compact( 'user' ) );
        endif;
        */
            $isEdit = true;
            return view('admin.filhos.editar.index', compact('user', 'isEdit'));
        else :
            return redirect('admin/users/cadastrar')->with('teste', 1);

        endif;
    }
    
   
    
    
 
    public function atualizar(Request $request, $id)
    {
        try {



            if ($request->password == $request->confirm_password) {

                $data_hoje = date("d/m/y");
                $data_nascimento = date('d/m/y', strtotime($request->dt_data_nascimento));

                $data_hoje = implode('-', array_reverse(explode('/', $data_hoje)));
                $data_nascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

                $d1 = strtotime($data_hoje);
                $d2 = strtotime($data_nascimento);

                $idade = ($d1 - $d2) / (86400 * 365);
                //dd($hoje- date('d/m/y',strtotime($request->dt_data_nascimento)));


                if ($idade < 5) {
                    return redirect()->back()->with('idade', 1);
                }
                // Verifica se informou o arquivo e se é válido



                // dd($lastId['id']);

//                $lastId = $lastId['id'] + 1;

                // dd($lastId);


//                $fakeEmail = $request->vc_nomeUtilizador . $lastId . '@gmail.com';
                // dd($lastId['id']);
                // dd($fakeEmail);




                $upload = $this->upload_img($request);
                
                $dados['tipoUtilizador'] = 'Filho';
//                $dados['vc_nomeUtilizador'] = $request->vc_primemiroNome . ' ' . $request->vc_apelido;
                User::find($id)->update([
//                    'vc_nomeUtilizador' => $dados['vc_nomeUtilizador'],
                    // 'vc_email' => $request->vc_email,
//                    'vc_email' => $fakeEmail,
                    'tipoUtilizador' => $dados['tipoUtilizador'],
                    'vc_telefone' =>  isset($request->vc_telefone) ? $request->vc_telefone : null,
                    'vc_primemiroNome' => $request->vc_primemiroNome,
                    'vc_nome_meio' => isset($request->vc_nome_meio) ? $request->vc_nome_meio : null,
                    'vc_apelido' => $request->vc_apelido,
                    'vc_genero' => $request->vc_genero,
                    'vc_BI' => $request->vc_BI,
                    'dt_data_nascimento' => $request->dt_data_nascimento,

                    'password' => Hash::make($request->password),
               
                    'profile_photo_path' => $upload
                ]);

               $this->Logger->Log('info', 'Actualizou o utilizador de id '.$id);
              
                return redirect()->back()->with('editado', 1);
            } else {

                return redirect()->back()->with('error', 1);
            }
        } catch (\Exception $exception) {

          return redirect()->back()->with('error', 1);
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
  
}
