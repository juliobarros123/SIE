<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activador_da_candidatura extends Model
{
    use HasFactory;
    protected $table = 'activadores_das_candidaturas';
    protected $fillable = ['it_estado'];
}
