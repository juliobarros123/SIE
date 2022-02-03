<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalheArquivoVideo extends Model
{
    use HasFactory;
    
    protected $fillable=[ 
    'vc_tipo_de_aquirvo',
    'vc_tamanho',
    'id_video'];
}
