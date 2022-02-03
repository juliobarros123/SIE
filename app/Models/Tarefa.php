<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model {
    use HasFactory;
    protected $fillable = [
        'vc_tarefa',
        'dt_data_entrega',
        'vc_descricao',
        'id_classe_disciplinas',
        'it_estado'];
    }

