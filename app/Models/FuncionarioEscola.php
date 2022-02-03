<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioEscola extends Model {
    use HasFactory;

    protected $fillable = [
        'it_id_escola',
        'it_id_classedisciplina',
        'it_id_utilizador',
        'it_estado'
    ];
}
