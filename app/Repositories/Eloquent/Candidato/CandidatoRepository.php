<?php

namespace App\Repositories\Eloquent\Candidato;

use App\Models\Candidato;
use App\Models\Team;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;

class CandidatoRepository
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
     * @return \App\Models\Candidato
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function salvar(array $dados, $id_candidato)
    {
        $candidato = Candidato::create([
            'curriculo'=>$dados['caminho_curriculo'],
            'id_canditado'=>$id_candidato,
            'id_vaga'=>$dados['id_vaga'],
            'slug'=>slug_gerar()
        ]);
        return $candidato;
    }

    public function update(Request $request, $slug)
    {
        
        $array = $request->all();
        $input = 'caminho_discricao';
        $caminho = 'Candidato/caminho_discricao';

        $caminho = $this->file->upload_fileArray($request, $input, $caminho);

        $input_capa = 'capa';
        $capa_caminho = 'Candidato/capa';
        $capa = $this->file->upload_fileArray($request, $input_capa, $capa_caminho);
        $Candidato = Candidato::where('slug',$slug)->update([
            'capa' => isset($capa) ? $capa : null,
            'caminho_discricao' => isset($caminho) ? $caminho : null,
            'remuneracao' => isset($array['remuneracao']) ? $array['remuneracao'] : null,
            // 'id_empresa' => isset($array['id_empresa']) ? $array['id_empresa'] : null,
            'id_empresa' => 1,
            'funcao' => isset($array['funcao']) ? $array['funcao'] : null,
            'datalimite' => isset($array['datalimite']) ? $array['datalimite'] : null,
            
           
            'quantidade' => isset($array['quantidade']) ? $array['quantidade'] : null,
     


           
        ]);
        return   $Candidato ;
    }

    
    public function all()
    {
        return    Candidato::join('users','users.id','candidatos.id_canditado')
        ->join('vagas','vagas.id','candidatos.id_vaga')
        ->select('users.profile_photo_path','users.primeiro_nome','users.ultimo_nome','users.email','users.telefone','candidatos.*');
    }

}
