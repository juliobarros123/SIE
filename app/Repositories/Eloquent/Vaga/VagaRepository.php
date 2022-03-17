<?php

namespace App\Repositories\Eloquent\Vaga;

use App\Models\Vaga;
use App\Models\Team;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VagaRepository
// interface UtilizadorRepository extends UtilizadorInterface

{

    private $Logger;
    protected $file;
    public function __construct(FileRepository $file)
    {
        $this->file = $file;

    }
    // use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Empresa
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function salvar(Request $request, $id_user)
    {
        // dd($request);

        $array = $request->all();
        $input = 'caminho_discricao';
        $caminho = 'vaga/caminho_discricao';

        $caminho = $this->file->upload_fileArray($request, $input, $caminho);

        $input_capa = 'capa';
        $capa_caminho = 'vaga/capa';
        $capa = $this->file->upload_fileArray($request, $input_capa, $capa_caminho);
        
        $vaga = Vaga::create([
            'capa' => isset($capa) ? $capa : null,
            'caminho_discricao' => isset($caminho) ? $caminho : null,
            'remuneracao' => isset($array['remuneracao']) ? $array['remuneracao'] : null,
            // 'id_empresa' => isset($array['id_empresa']) ? $array['id_empresa'] : null,
            'id_empresa' => 1,
            'tipo_vaga'=>isset($array['tipo_vaga']) ? $array['tipo_vaga'] : null,
            'funcao' => isset($array['funcao']) ? $array['funcao'] : null,
            'datalimite' => isset($array['datalimite']) ? $array['datalimite'] : null,
            
           
            'quantidade' => isset($array['quantidade']) ? $array['quantidade'] : null,
            'slug'=>slug_gerar()


           
        ]);
        return $vaga;
    }

public function vagasMinhasEmpresas($id_propreitario){
    if (Auth::User()->tipoUtilizador == 'Empresario'){
        $this->all()->where('empresas.propreitario',$id_propreitario)->select('vagas.*');
    }else{
       return $this->all()->select('vagas.*');;
    }
                   
            

}
    public function all()
    {
    return  Vaga::join('empresas','vagas.id_empresa','empresas.id')->select('vagas.*','empresas.nome','empresas.id','empresas.propreitario');
       
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    public function update(Request $request, $slug)
    {
        
        $array = $request->all();
        $input = 'caminho_discricao';
        $caminho = 'vaga/caminho_discricao';

        $caminho = $this->file->upload_fileArray($request, $input, $caminho);

        $input_capa = 'capa';
        $capa_caminho = 'vaga/capa';
        $capa = $this->file->upload_fileArray($request, $input_capa, $capa_caminho);
        $vaga = Vaga::where('slug',$slug)->update([
            'capa' => isset($capa) ? $capa : null,
            'caminho_discricao' => isset($caminho) ? $caminho : null,
            'remuneracao' => isset($array['remuneracao']) ? $array['remuneracao'] : null,
            'id_empresa' => isset($array['id_empresa']) ? $array['id_empresa'] : null,
            // 'id_empresa' => 1,
            'funcao' => isset($array['funcao']) ? $array['funcao'] : null,
            'datalimite' => isset($array['datalimite']) ? $array['datalimite'] : null,
            'tipo_vaga'=>isset($array['tipo_vaga']) ? $array['tipo_vaga'] : null,
           
            'quantidade' => isset($array['quantidade']) ? $array['quantidade'] : null,
     


           
        ]);
        return   $vaga ;
    }
}
