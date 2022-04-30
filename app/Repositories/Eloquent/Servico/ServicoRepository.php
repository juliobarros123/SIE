<?php

namespace App\Repositories\Eloquent\Servico;

use App\Models\Servico;
use App\Models\Team;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ServicoRepository
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
     * @return \App\Models\Servico
     * @param mixed $id
     */

    // public function get($id){

    // }

    // public function get($id){

    // }

    public function salvar(array $request)
    {
        $request['slug']=slug_gerar();
        $empresa = Servico::create($request);
        return $empresa;
    }


    public function all()
    {
    return    Servico::join('empresas','empresas.id','servicos.id_empresa')->select('servicos.*','empresas.nome');
       
    }
   
    

    public function update(array $request, $slug)
    {
    
        $empresa = Servico::where('slug',$slug)->update($request);
        return $empresa;
    }
    public function eliminar($slug)
    {
        $empresa = Servico::where('slug',$slug)->delete();
        return $empresa;
    }
}
