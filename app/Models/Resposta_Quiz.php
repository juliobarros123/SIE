<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Resposta_Quiz extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'resposta',
        'id_questao',
        'slug',
        'estado'
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'resposta'
            ]
        ];
    }
}
