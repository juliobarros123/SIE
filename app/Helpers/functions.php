<?php
use Keygen\Keygen;

  function slug_gerar()
{
    
    $slug =Keygen::numeric(2)->generate().uniqid(date('HisYmd')). Keygen::numeric(4)->generate();
  
    return  $slug;
}
?>