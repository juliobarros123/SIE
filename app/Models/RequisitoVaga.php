<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RequisitoVaga extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'requisito1',
        'requisito2',
        'requisito3',
        'requisito4',
        'id_vaga',
        'slug'
    ];

}
