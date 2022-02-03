<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'logotipo',
        'nome',
        'email',
        'telefone',
        'nif',
        'endereco',
        'propreitario',
        'slug'
    ];

    protected $dates = ['deleted_at'];
}
