<?php

namespace App\Repositories\Eloquent\Empresa;

use App\Models\Empresa;
use App\Models\Team;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EmpresaRepository
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

        // $request = $input;
        $input = 'logotipo';
        $caminho = 'empresa/logotipo';
        $array = $request->all();
        $img = $this->file->upload_fileArray($request, $input, $caminho);

        $empresa = Empresa::create([
            'logotipo' => isset($img) ? $img : null,
            'nome' => isset($array['nome']) ? $array['nome'] : null,
            'telefone' => isset($array['telefone']) ? $array['telefone'] : null,
            'email' => isset($array['email']) ? $array['email'] : null,
            'nif' => isset($array['nif']) ? $array['nif'] : null,
            'endereco' => isset($array['endereco']) ? $array['endereco'] : null,
         
            'propreitario' => isset($id_user) ? $id_user : null,
            'slug'=>slug_gerar()
        ]);
        return $empresa;
    }


    public function all()
    {
    return    Empresa::join('users','users.id','empresas.propreitario')->select('users.primeiro_nome','users.ultimo_nome','empresas.*');
       
    }
    public function vagaPorEmpresaContabilizado()
    {
       
    return    Empresa::leftJoin('vagas','vagas.id_empresa','empresas.id')->groupBy('empresas.id')->select('empresas.*',DB::raw('sum(vagas.quantidade) as vagas'));
       
    }
public function candidatoAceitePorEmpresasContabilizado(){
  return  Empresa::leftJoin('vagas','vagas.id_empresa','empresas.id')
         ->leftJoin('candidatos','candidatos.id_vaga','vagas.id')
    //   ->join('users','users.id','candidatos.id_canditado')
     ->groupBy('empresas.id')->where('candidatos.estado',2)->select('empresas.*','candidatos.estado',DB::raw('count(candidatos.id) as candidatos'))
    ;
}
    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */

    public function update(Request $request, $slug)
    {
        
        $input = 'logotipo';
        $caminho = 'empresa/logotipo';
        $array = $request->all();
        $img = $this->file->upload_fileArray($request, $input, $caminho);
        
          return    Empresa::where('slug',$slug)->update([
        'logotipo' => isset($img) ? $img : null,
        'nome' => isset($array['nome']) ? $array['nome'] : null,
        'telefone' => isset($array['telefone']) ? $array['telefone'] : null,
        'email' => isset($array['email']) ? $array['email'] : null,
        'nif' => isset($array['nif']) ? $array['nif'] : null,
        'endereco' => isset($array['endereco']) ? $array['endereco'] : null,
        // 'propreitario' => isset($id_user) ? $id_user : null,
        
        ]);

    }
}
