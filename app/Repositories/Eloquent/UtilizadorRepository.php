<?php

namespace App\Repositories\Eloquent;

use App\Models\Team;
use App\Models\User;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UtilizadorRepository implements UtilizadorInterface
// interface UtilizadorRepository extends UtilizadorInterface

{
    protected $file;
    public function __construct()
    {
        $this->file = new FileRepository;

    }

    // use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function store(array $request)
    {
        $array = $request;
        $input = 'profile_photo_path';
        $caminho = 'userPhoto';

        $caminho = $this->file->upload_fileArray($array, $input, $caminho);
//  dd(  $caminho);
        return User::create([

            'nome' => isset($request['nome']) ? $request['nome'] : null,
            'primeiro_nome' => isset($request['primeiro_nome']) ? $request['primeiro_nome'] : null,
            'ultimo_nome' => isset($request['ultimo_nome']) ? $request['ultimo_nome'] : null,
            'email' => isset($request['email']) ? $request['email'] : null,
            'password' => isset($request['password']) ? Hash::make($request['password']) : null,
            'tipoUtilizador' => isset($request['tipoUtilizador']) ? $request['tipoUtilizador'] : null,
            'telefone' => isset($request['telefone']) ? $request['telefone'] : null,
            'genero' => isset($request['genero']) ? $request['genero'] : null,
            'profile_photo_path' => isset($caminho) ? $caminho : null,
            'slug' => slug_gerar(),
        ]);

    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->vc_nome, 2)[0] . "'s Team",
            'personal_team' => true,
        ]));
    }

    public function update(array $request, $slug)
    {


        $input = 'profile_photo_path';
        $caminho = 'userPhoto';
        if (isset($request['profile_photo_path'])) {
            $caminho = $this->file->upload_fileArray($request, $input, $caminho);
        }

        return User::where('slug', $slug)->update([
            'nome' => isset($request['nome']) ? $request['nome'] : null,
            'primeiro_nome' => isset($request['primeiro_nome']) ? $request['primeiro_nome'] : null,
            'ultimo_nome' => isset($request['ultimo_nome']) ? $request['ultimo_nome'] : null,
            'email' => isset($request['email']) ? $request['email'] : null,
         
           
            'telefone' => isset($request['telefone']) ? $request['telefone'] : null,
            'genero' => isset($request['genero']) ? $request['genero'] : null,
            'profile_photo_path' => isset($request['profile_photo_path']) ? $caminho : User::find(Auth::User()->id)->profile_photo_path,

        ]);

    }

    
    public function atualizarPasse(Request $input, $id)
    {

        // if (!$this->validar_autoria($id)) {
        //     return redirect()->back()->with('acao_nao_autorizado', 1);
        // }

        try {
            $user = User::find($id);
            if (Hash::check($input->password, $user->password)) {
                if ($input->nova_passe == $input->password_confirmation) {

                    $dados = $input->all();
                    $this->user->update_senha($dados, $id);
                    $this->Logger->Log('info', 'Actualizou o utilizador de id ' . $id);
                    return redirect('admin/users/listar')->with('editado', 1);
                } else {
                    return redirect()->back()->with('passe_nao_bate', 1);
                }
            } else {
                return redirect()->back()->with('passe_nao_existe', 1);
            }
        } catch (\Exception $exception) {

//            dd($exception);

            return redirect()->back()->with('error', 1);
        }
    }

    public function update_senha(array $input, $slug)
    {

//        $input = $input[0];

        User::where('slug',$slug)->update([

            'password' => Hash::make($input['password_nova']),

        ]);
    }
}
