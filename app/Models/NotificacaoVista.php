<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificacaoVista extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_notificacao',
        'estado'
    ];
}
