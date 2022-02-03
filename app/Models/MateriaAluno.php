<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaAluno extends Model
{
    use HasFactory;
    protected $fillable=[
    'it_id_utilizador',
    'it_id_materia',
    'it_estado'];
}
