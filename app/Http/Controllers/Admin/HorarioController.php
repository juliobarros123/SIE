<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Logger;
use App\Models\AnoLectivo;
use App\Models\Dias_semanas;
use App\Models\Hora;
use App\Models\ClasseDisciplina;
use App\Models\Classe;
use App\Models\Disciplina;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\NotificacaoController;

class HorarioController extends Controller
{
    
     
    private $Logger,$notificacao;
    private $menuDisciplina;
    public function __construct(NotificacaoController $notificacao)
    {
        $this->menuDisciplina = new MenuController();
        $this->Logger = new Logger();
        $this->notificacao =$notificacao;
    }

    public function index()
    {
        $notificacao=$this->notificacao->notificacarMateria();
        $response['notificacao']=$notificacao; 
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $response['disciplinas2'] = $disciplinas2;
        $horarios = DB::table('horarios')
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('horarios.id as id_horarios', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'anoslectivos.*')
            ->where('horarios.it_estado', 1)->get();
        $response['horarios'] = $horarios;
        return view('admin.horarios.index', $response);
    }

    public function create()
    {
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $response['disciplinas2'] = $disciplinas2;
        $response['dias'] = Dias_semanas::where('it_estado', 1)->get();
        $response['horas'] = Hora::where('it_estado', 1)->get();
        $classesDisciplinas = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();
        $response['anoLectivo'] =   AnoLectivo::find(AnoLectivo::all()->max('id'));
        
        $quantidade_anoLectivo=AnoLectivo::all()->count();
        $quantidade_classeDisciplina=ClasseDisciplina::all()->count();
        $response['sim']= $quantidade_classeDisciplina*$quantidade_anoLectivo;
        return view('admin.horarios.criar.index', $response, compact('classesDisciplinas'));
    }

    public function store(Request $request)
    {
        $classe_disciplina=ClasseDisciplina::find($request->it_id_classedisciplina);
        $classe=Classe::find($classe_disciplina->classe_id);
        $disciplina=Disciplina::find($classe_disciplina->disciplina_id);
        $dias_semanas=Dias_semanas::find($request->it_id_dias);

       $estado=$this->vrf_horario_existente($request);
       if (!$estado) {
           if ($request->vc_hora_inicio < $request->vc_hora_fim) {
               Horario::create($request->all());
               $this->Logger->Log('info', 'Adicionou um horário que vai das '.$request->vc_hora_inicio.' até as '.
               $request->vc_hora_fim.' para às '.$dias_semanas->vc_dia.'s da '.$classe->vc_classe.'ªclasse da disciplina de '.$disciplina->vc_disciplina);
               return redirect()->back()->with('status', 1);
           } else {
               return redirect()->back()->with('aviso', 1);
           }
       }else{
        return redirect()->back()->with('has', 1);
       }
    }

    public function vrf_horario_existente($horario){
     return 
         Horario::where('it_id_classedisciplina',$horario->it_id_classedisciplina)
        ->where('vc_hora_inicio',$horario->vc_hora_inicio)
        ->where('vc_hora_fim',$horario->vc_hora_fim)
        ->where('it_id_dias',$horario->it_id_dias)
        ->where('it_id_anoslectivos',$horario->it_id_anoslectivos)
        ->where('it_estado',1)
        ->count();
    }

    public function edit($id)
    {
        $disciplinas2 = $this->menuDisciplina->listarPorId();
        $response['disciplinas2'] = $disciplinas2;
        $horario = DB::table('horarios')
            ->join('dias_semanas', 'dias_semanas.id', 'horarios.it_id_dias')
            ->join('anoslectivos', function ($join) {
                $join->on('horarios.it_id_anoslectivos', '=', 'anoslectivos.id');
            })
            ->join('classe_disciplinas', function ($join) {
                $join->on('horarios.it_id_classedisciplina', '=', 'classe_disciplinas.id');
            })->join('classes', function ($join) {
                $join->on('classe_disciplinas.classe_id', '=', 'classes.id');
            })->join('disciplinas', function ($join) {
                $join->on('classe_disciplinas.disciplina_id', '=', 'disciplinas.id');
            })->select('horarios.id as id_horario', 'disciplinas.*', 'horarios.*', 'classes.*', 'dias_semanas.*', 'dias_semanas.id as id_dias_semana', 'classe_disciplinas.id as id_c_d', 'anoslectivos.*')
            ->where('horarios.id', $id)
            ->where('horarios.it_estado', 1)->get();
        $response['dias'] = Dias_semanas::where('it_estado', 1)->get();
        $response['classesDisciplinas'] = DB::table('classe_disciplinas')
            ->join('classes', function ($join) {
                $join->on('classes.id', '=', 'classe_disciplinas.classe_id');
            })
            ->join('disciplinas', function ($join) {
                $join->on('disciplinas.id', '=', 'classe_disciplinas.disciplina_id');
            })->select('classe_disciplinas.id as id_c_d', 'classe_disciplinas.*', 'disciplinas.*', 'classes.*')
            ->where('classe_disciplinas.it_estado', '=', 1)->get();
        $response['anoLectivo'] =   AnoLectivo::find(AnoLectivo::all()->max('id'));

        $response['anosLectivo'] = AnoLectivo::all();
        return view('admin.horarios.editar.index', $response, compact('horario'));
    }


    public function update(Request $request, $id)
    {
     
     $estado=$this->vrf_horario_existente($request);
       if (!$estado) {
           if ($request->vc_hora_inicio < $request->vc_hora_fim) {
               Horario::find($id)->update($request->all());
               $this->Logger->Log('info', 'Actualizou o horário com o id '.$id);
               return redirect()->back()->with('status', ' 1');
           } else {
               return redirect()->back()->with('aviso', 1);
           }
       }else {
        return redirect()->back()->with('has', 1);
       }
    }


    public function delete($id)
    {
        Horario::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou horário de id '.$id);
        return redirect()->back()->with('eliminar', 1);
    }
}