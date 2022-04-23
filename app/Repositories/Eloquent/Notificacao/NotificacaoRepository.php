<?php

namespace App\Repositories\Eloquent\Notificacao;

use App\Models\Notificacao;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificacaoRepository
// interface UtilizadorRepository extends UtilizadorInterface

{

    private $Logger;
    protected $file;
   
    // use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Notificacao
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function salvar($notificacao,$tipo,$url,$id_remetente,$id_destinatario )
    {

        $notificacao = Notificacao::create([
           'notificacao'=>$notificacao,
            'tipo'=>$tipo,
            'url'=>$url,
            'id_remetente'=>$id_remetente,
            'id_destinatario'=>$id_destinatario,
            'slug'=>slug_gerar()
        ]);
        return $notificacao;
    }
    public function notificacaoInsert($notificacao,$tipo,$url,$id_userLogado,$id_remetente)
    {
  
    
        $this->salvar($notificacao,$tipo,$url,$id_userLogado,$id_remetente );
           
    }
    public function update(Request $request, $slug)
    {

        $array = $request->all();
        $input = 'caminho_discricao';
        $caminho = 'Notificacao/caminho_discricao';

        $caminho = $this->file->upload_fileArray($request, $input, $caminho);

        $input_capa = 'capa';
        $capa_caminho = 'Notificacao/capa';
        $capa = $this->file->upload_fileArray($request, $input_capa, $capa_caminho);
        $Notificacao = Notificacao::where('slug', $slug)->update([
            'capa' => isset($capa) ? $capa : null,
            'caminho_discricao' => isset($caminho) ? $caminho : null,
            'remuneracao' => isset($array['remuneracao']) ? $array['remuneracao'] : null,
            // 'id_empresa' => isset($array['id_empresa']) ? $array['id_empresa'] : null,
            'id_empresa' => 1,
            'funcao' => isset($array['funcao']) ? $array['funcao'] : null,
            'datalimite' => isset($array['datalimite']) ? $array['datalimite'] : null,

            'quantidade' => isset($array['quantidade']) ? $array['quantidade'] : null,

        ]);
        return $Notificacao;
    }

    public function all()
    {
        // 'quantidade',
        // 'remuneracao',
        // 'id_empresa',
        // 'funcao',
        // 'capa',
        // 'datalimite',
        // 'tipo_vaga',
        // 'caminho_discricao',
        // 'slug'
        return Notificacao::join('users', 'users.id', 'Notificacaos.id_canditado')
            ->leftJoin('vagas', 'vagas.id', 'Notificacaos.id_vaga')
            ->leftJoin('empresas', 'empresas.id', 'vagas.id_empresa')
            ->select('users.profile_photo_path', 'users.primeiro_nome',
             'users.ultimo_nome', 'users.email', 'users.telefone', 'Notificacaos.*',
             'vagas.quantidade',    'vagas.funcao',    'vagas.datalimite',    'vagas.capa','empresas.nome','vagas.tipo_vaga');
    }

    public function NotificacaoPorVagaContabilizado()
    {
        return $this->all()->groupBy('vagas.id')->select('vagas.funcao', 'vagas.tipo_vaga', 'Notificacaos.estado', DB::raw('count(Notificacaos.id) as candidatos'));

    }
    public function minhas_vagas($slug_candidato){
     return    $this->all()->where('users.slug',$slug_candidato);
    
    }
}
