<?php

namespace App\Repositories\Eloquent\Comentario;

use App\Models\Comentario;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioRepository
// interface UtilizadorRepository extends UtilizadorInterface

{

 
    // use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Comentario
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function salvar(array $dados)
    {
        $dados['slug'] = slug_gerar();
        $candidato = Comentario::create($dados);
        return $candidato;
    }

    public function update(Request $request, $slug)
    {

    }

    public function all()
    {
     
        return Comentario::orderBy('id','desc');
    }

    public function candidatoPorVagaContabilizado()
    {
        return $this->all()->groupBy('vagas.id')->select('vagas.funcao', 'vagas.tipo_vaga', 'candidatos.estado', DB::raw('count(candidatos.id) as candidatos'));

    }
    public function minhas_vagas($slug_candidato){
     return    $this->all()->where('users.slug',$slug_candidato);
    
    }
}
