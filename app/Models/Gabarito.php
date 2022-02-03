<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gabarito extends Model
 {
    protected $fillable = [
        'vc_gabarito',
        'vc_descricao_gabarito',
        'it_id_tarefas',
        'it_estado'
    ];
    use HasFactory;
}
