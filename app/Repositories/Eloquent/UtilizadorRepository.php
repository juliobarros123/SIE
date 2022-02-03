<?php

namespace App\Repositories\Eloquent;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilizadorRepository implements UtilizadorInterface
// interface UtilizadorRepository extends UtilizadorInterface

{

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

    public function store(array $input)
    {

        return DB::transaction(function () use ($input) {
            return tap(
                User::create([

                    'nome' => isset($input['nome']) ? $input['nome'] : null,
                    'primeiro_nome' => isset($input['primeiro_nome']) ? $input['primeiro_nome'] : null,
                    'ultimo_nome' => isset($input['ultimo_nome']) ? $input['ultimo_nome'] : null,
                    'email' => isset($input['email']) ? $input['email'] : null,
                    'password' => isset($input['password']) ? Hash::make($input['password']) : null,
                    'tipoUtilizador' => isset($input['tipoUtilizador']) ? $input['tipoUtilizador'] : null,
                    'telefone' => isset($input['telefone']) ? $input['telefone'] : null,
                    'genero' => isset($input['genero']) ? $input['genero'] : null,
                    'profile_photo_path' => isset($input['profile_photo_path']) ? $input['profile_photo_path'] : null,
                    'slug'=>slug_gerar()
                ]),
                function (User $user) {

                    return $this->createTeam($user);
                }
            );
        });
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

    public function update(array $input, $slug)
    {

        return User::where('slug',$slug)->update([
            'nome' => isset($input['nome']) ? $input['nome'] : null,
            'primeiro_nome' => isset($input['primeiro_nome']) ? $input['primeiro_nome'] : null,
            'ultimo_nome' => isset($input['ultimo_nome']) ? $input['ultimo_nome'] : null,
            'email' => isset($input['email']) ? $input['email'] : null,
            'password' => isset($input['password']) ? Hash::make($input['password']) : null,
            'tipoUtilizador' => isset($input['tipoUtilizador']) ? $input['tipoUtilizador'] : null,
            'telefone' => isset($input['telefone']) ? $input['telefone'] : null,
            'genero' => isset($input['genero']) ? $input['genero'] : null,
            'profile_photo_path' => isset($input['profile_photo_path']) ? $input['profile_photo_path'] : null,
         
        ]);

    }
}
