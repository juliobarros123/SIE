<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LogUser extends Model
{
    use HasFactory;
    protected $table = 'logs';
    protected $fillable = [
        'it_idUser',
        'vc_descricao',
    ];

    public  function LogsForSearch($anoLectivo, $utilizador)
    {

        $response['logs'] =DB::table('logs')
        ->join('users', 'users.id', '=', 'logs.it_idUser')
        ->select('logs.*','users.vc_primemiroNome','users.vc_apelido')
        ->whereYear('logs.created_at', '=', $anoLectivo)
        ->where([
            ['users.vc_apelido', '=', $utilizador]
          ]);
          if ($anoLectivo == 'Todos' && $utilizador == 'Todos') {
            $response['logs'] =DB::table('logs')
        ->join('users', 'users.id', '=', 'logs.it_idUser')
        ->select('logs.*','users.vc_primemiroNome','users.vc_apelido');
        }else if($anoLectivo == 'Todos' && $utilizador )
        {
            
        $response['logs'] =DB::table('logs')
        ->join('users', 'users.id', '=', 'logs.it_idUser')
        ->select('logs.*','users.vc_primemiroNome','users.vc_apelido')
        ->where([
            ['users.vc_apelido', '=', $utilizador]
          ]);
        }else if($utilizador == 'Todos' && $anoLectivo )
        {
            $response['logs'] =DB::table('logs')
            ->join('users', 'users.id', '=', 'logs.it_idUser')
            ->select('logs.*','users.vc_primemiroNome','users.vc_apelido')
            ->whereYear('logs.created_at', '=', $anoLectivo);
        }

        return  $response['logs']->get();
    }
}
