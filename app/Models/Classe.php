<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Classe extends Model {
    use HasFactory;
    protected $fillable = [
        'vc_classe',
        'it_estado'
    ];

    public function disciplinas() {
        return $this->belongsToMany( Disciplina::class, 'classe_disciplinas', 'classe_id', 'disciplina_id' );
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'matriculas',
            'it_id_classe',
            'it_id_utilizador');

    }
}
