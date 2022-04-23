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
function quantos_dias($timestamps)
{
        
    // $data_inicio = new DateTime($timestamps);
    // $data_fim = new DateTime(date('Y-m-d h:i:s'));
    
    // Resgata diferença entre as datas
    $dateInterval =datetimeDiff($timestamps,date('Y-m-d H:i:s'));


if($dateInterval->day!=0){
    return 'há '.$dateInterval->day.' dias atrás';
} else if($dateInterval->hour!=0){
    return 'há '.$dateInterval->hour.' horas atrás';
} else if($dateInterval->min!=0){
    return 'há '.$dateInterval->min.' minutos atrás';
}else{
    return 'há '.$dateInterval->sec.' segundos atrás';;
}
}
function datetimeDiff($dt1, $dt2){
    $t1 = strtotime($dt1);
    $t2 = strtotime($dt2);

    $dtd = new stdClass();
    $dtd->interval = $t2 - $t1;
    $dtd->total_sec = abs($t2-$t1);
    $dtd->total_min = floor($dtd->total_sec/60);
    $dtd->total_hour = floor($dtd->total_min/60);
    $dtd->total_day = floor($dtd->total_hour/24);

    $dtd->day = $dtd->total_day;
    $dtd->hour = $dtd->total_hour -($dtd->total_day*24);
    $dtd->min = $dtd->total_min -($dtd->total_hour*60);
    $dtd->sec = $dtd->total_sec -($dtd->total_min*60);
    return $dtd;
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