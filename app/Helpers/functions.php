<?php
use Keygen\Keygen;
use App\Repositories\Eloquent\Vaga\VagaRepository;
use App\Repositories\Eloquent\File\FileRepository;
use Illuminate\Support\Facades\Mail;
  function slug_gerar()
{
    
    $slug =Keygen::numeric(2)->generate().uniqid(date('HisYmd')). Keygen::numeric(4)->generate();
  
    return  $slug;
}

function vagas_disponiveis()
{
        $vaga=new VagaRepository(new FileRepository);
      return  $vaga->all()->whereDate('vagas.datalimite','>=',now())->get();

}
function anos(){
  $years = range(1900, strftime("%Y", time())); 
  return $years;
}


 
?>