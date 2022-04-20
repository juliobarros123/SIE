<?php
use Keygen\Keygen;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\Empresa;
use App\Models\Vaga;
use App\Models\User;
use App\Models\Candidato;
use App\Models\Notificacao;
  function slug_gerar()
{
    
    $slug =Keygen::numeric(2)->generate().uniqid(date('HisYmd')). Keygen::numeric(4)->generate();
  
    return  $slug;
}

function vagas_disponiveis()
{
        $vaga=new VagaRepository(new FileRepository);
      return  $vaga->all()->orderBy('vagas.id','desc')->whereDate('vagas.datalimite','>=',now());

}
function anos(){
  $years = range(1900, strftime("%Y", time())); 
  return $years;
}
function ttl_utilizadores(){

  return User::count();
}
function ttl_empresas(){

  return Empresa::count();
}
function ttl_empresarios(){

  return User::where('tipoUtilizador','Empresario')->count();
}
function ttl_vagas(){
  return Vaga::sum('quantidade');
}
function ttl_candidatos_aceites(){
 return  Candidato::where('estado',2)->count();
}

function notificacoes(){
 return Notificacao::all();
}
?>