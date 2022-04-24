<?php

namespace App\Repositories\Eloquent\File;

use App\Models\Team;
use App\Models\Empresa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FileRepository
// interface UtilizadorRepository extends UtilizadorInterface

{

    // use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
   
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }


    public function upload_fileArray($request, $input, $caminho)
    {

     
        if (isset($request[$input])&& $request[$input]->isValid()) {
       
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request[$input]->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request[$input]->storeAs($caminho, $nameFile);
            //            dd($upload,"O");

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
    public function upload_file($request, $input, $caminho)
    {
        dd($request, $input, $caminho);
        if ($request[$input] && $request[$input]->isValid()) {

            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = uniqid(date('HisYmd'));

            // Recupera a extensão do arquivo
            $extension = $request[$input]->extension();

            // Define finalmente o nome
            $nameFile = "{$name}.{$extension}";

            // Faz o upload:
            $upload = $request[$input]->storeAs($caminho, $nameFile);
            //            dd($upload,"O");

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

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */


    // public function update(array $input, $id)
    // {

    
    // return    User::find($id)->update([
    //                        'nome' =>  isset($input['nome'])?$input['nome']:null,
    //                 'primeiro_nome' => isset($input['primeiro_nome'])?$input['primeiro_nome']:null,
    //                 'ultimo_nome' => isset($input['ultimo_nome'] )?$input['ultimo_nome'] :null,
    //                 'email' =>  isset($input['email'])?$input['email']:null,
                  
    //                 'tipoUtilizador' =>isset( $input['tipoUtilizador'] )? $input['tipoUtilizador'] :null,
    //                 'telefone' => isset($input['telefone'] )?$input['telefone'] :null,
    //                 'genero' =>isset( $input['genero'] )? $input['genero'] :null,
    //                 'profile_photo_path'=>isset( $input['profile_photo_path'] )? $input['profile_photo_path'] :null,
    //     ]);

    // }
}
