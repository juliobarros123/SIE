<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaga extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'quantidade',
        'remuneracao',
        'id_empresa',
        'funcao',
        'capa',
        'datalimite',
        'tipo_vaga',
        'caminho_discricao',
        'slug'
    ];

    protected $dates = ['deleted_at'];

}
