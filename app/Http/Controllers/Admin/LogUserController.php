<?php

namespace App\Http\Controllers\Admin;
 use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\DB as FacadesDB;

class LogUserController extends Controller
{

  public function pesquisar()
  {
    
      // $response['anos'] =  $response['logs'] =DB::table('logs')
      // ->selectRaw('YEAR(created_at) as ano')->distinct('YEAR(created_at)')->get();

      $response['utilizadores'] =  User::all();
          // dd($response['utilizadores']);
      return view('admin/logs/pesquisar/index', $response);
  }
  public function recebelogs(Request $request)
  {
      $anoLectivo =  $request->vc_anolectivo;
      $utilizador = $request->vc_nome;
      return redirect("admin/logs/visualizar/index/$anoLectivo/$utilizador");
  }
  public function visualizar(Request $request)
  {
    // dd($request);
    $logs=LogUser::join('users', 'users.id', '=', 'logs.it_idUser');
     
        if($request->id_utilizador!="Todos"){
          $logs=$logs->where('logs.it_idUser',$request->id_utilizador);
      }
      if($request->ano!="Todos"){
          $logs=$logs->whereYear('logs.created_at',$request->ano);
      }
     
      $response['logs']=$logs->select('logs.*','users.primeiro_nome','users.ultimo_nome')->get();
  return view('admin.logs.visualizar.index',$response);
     
  }

}
