<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class Escola extends Model {
    use HasFactory;

    protected $fillable = [
        'vc_escola',
        'vc_logo',
        'vc_num_ide',
        'vc_localizacao',
        'it_id_provincia',
        'it_id_minicipio',
        'vc_director',
        'vc_email',
        'vc_senha',
        'it_id_utilizador',
        'dt_data_registro',
        'it_estado'
    ];
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'matriculas',
            'it_id_escola',
            'it_id_utilizador');

    }
    public  function Municipio($anoLectivo,$municipio)
    {
        $escola = DB::table('matriculas')
        ->join('anoslectivos','anoslectivos.id','matriculas.it_id_anolectivo')
        ->join('escolas','escolas.id','matriculas.it_id_escola');
        $escola->select('escolas.it_id_minicipio as m','anoslectivos.id','anoslectivos.ya_inicio',
        'anoslectivos.ya_fim',db::raw('count(matriculas.id) as total'))->groupBy('m');

        if ($anoLectivo && $anoLectivo != 'Todos') {
            $escola->where([['anoslectivos.id', $anoLectivo]]);
        }
        if ($municipio && $municipio != 'Todos') {
            $escola->where([['escolas.it_id_minicipio', $municipio]]);
        }

        return $escola->get();
    }
}
