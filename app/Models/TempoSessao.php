<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempoSessao extends Model
{
    use HasFactory;
    protected $fillable=[
        'tempo_contagem',
        'tempo_termino'
    ];
}
