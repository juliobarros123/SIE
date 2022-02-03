<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoUtilizador extends Model
{
    use HasFactory;
    protected $fillable=[
        'it_id_utilizador',
        'it_id_tarefa',
        'it_estado',
        'it_id_materia',
        'vc_assunto',
        'vc_descricao',
        'it_estado'
    ];
}
