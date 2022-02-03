<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodidoPalavraPasse extends Model
{
    use HasFactory;
    protected $fillable=[
        'id_user',
        'codigo',

        'tempo_criado',
        'tempo_expiracao',
        'hora'
      
    ];
}
