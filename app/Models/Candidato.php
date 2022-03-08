<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Candidato extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'curriculo',
        'id_canditado',
        'id_vaga',
        'slug',
        'estado'
    ];

    protected $dates = ['deleted_at'];
}
