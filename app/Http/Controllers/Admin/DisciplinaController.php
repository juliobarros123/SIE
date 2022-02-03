<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\MenuController;

class DisciplinaController extends Controller
{
    //
    private $Logger;
    private $disciplinas1;
    public function __construct()
    {
        $this->disciplinas1 = new MenuController();
        $this->Logger = new Logger();
    }
    public function  listar()
    {
        $disciplinas2 = $this->disciplinas1->listarPorId();
        $disciplinas = Disciplina::where('it_estado', 1)->get();
        return view('admin.disciplina.index', compact('disciplinas', 'disciplinas2'));
    }

    public function criar()
    {
       
        return view('admin.disciplina.criar.index');
    }

    public function cadastrar(Request $disciplina)
    {
        


         $estado=$this->vrf_disciplina_existente($disciplina->vc_disciplina);
        if (!$estado) {
            if ($disciplina->hasFile('vc_imagem') && $disciplina->file('vc_imagem')->isValid()) {
                $name = uniqid(date('HisYmd'));

                $extension = $disciplina->vc_imagem->extension();

                $nameFile = "{$name}.{$extension}";

                $upload = $disciplina->vc_imagem->storeAs('disciplinas', $nameFile);
                // $upload = substr( $upload ,7,strlen($upload)); 
                if (!$upload) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
                } else {
                    Disciplina::create(
                        [
                        'vc_disciplina' => $disciplina->vc_disciplina,
                        'vc_imagem' => $upload

                    ]
                    );

                    $this->Logger->Log('info', 'Adicionou a disciplina de '.$disciplina->vc_disciplina.' ao sistema');
                    return redirect()->back()->with('status', 1);
                }
            }
        }else{
             return redirect()->back()->with('has', 1);
        }
    }

    public function vrf_disciplina_existente($vc_disciplina){
    return Disciplina::where('vc_disciplina',$vc_disciplina)->count();
        }

    public function editar($id)
    {
        $disciplina =   Disciplina::find($id);
        return view('admin.disciplina.editar.index', compact('disciplina'));
        
    }

    public function actualizar(Request $disciplina, $id)
    {
        $disciplina_anterior=Disciplina::find($id);
        // $diciplina='';
        // $imagem='';
        // $complemento='';
        $estado=$this->vrf_disciplina_existente($disciplina->vc_disciplina);
        if (!$estado) {
            if ($disciplina->hasFile('vc_imagem') && $disciplina->file('vc_imagem')->isValid()) {
                $name = uniqid(date('HisYmd'));

                $extension = $disciplina->vc_imagem->extension();

                $nameFile = "{$name}.{$extension}";
                $upload = $disciplina->vc_imagem->storeAs('disciplinas', $nameFile);
                // $upload = substr( $upload ,7,strlen($upload)); 

                if (!$upload) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
                } else {
                    Disciplina::find($id)->update([
                    'vc_disciplina' => $disciplina->vc_disciplina,
                    'vc_imagem' => $upload

                ]);
                
                  $disciplina_actual=Disciplina::find($id);
                  //if($disciplina_anterior->vc_disciplina!=$disciplina_actual->vc_disciplina)
                  $diciplina=' de '.$disciplina_anterior->vc_disciplina.' para '.$disciplina_actual->vc_disciplina; 
                  
                //   if($disciplina_anterior->vc_imagem!=$disciplina_actual->vc_imagem)
                //   $imagem=' e nome da sua imagem de '.$disciplina_anterior->vc_imagem.' para '.$disciplina_anterior->vc_imagem; 
                  $complemento= $diciplina;//.$imagem;
                    $this->Logger->Log('info', 'Actualizou a disciplina '.$complemento);
                    return redirect()->route('disciplinas')->with('status', 1);
                }
            }
        }else{


            if ($disciplina->hasFile('vc_imagem') && $disciplina->file('vc_imagem')->isValid()) {
                $name = uniqid(date('HisYmd'));

                $extension = $disciplina->vc_imagem->extension();

                $nameFile = "{$name}.{$extension}";

                $upload = $disciplina->vc_imagem->storeAs('disciplinas', $nameFile);
                // $upload = substr( $upload ,7,strlen($upload)); 
                if (!$upload) {
                    return redirect()
                    ->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
                } else {
                    Disciplina::find($id)->update([
                    'vc_imagem' => $upload

                ]);
                
                  $disciplina_actual=Disciplina::find($id);
                  //if($disciplina_anterior->vc_disciplina!=$disciplina_actual->vc_disciplina)
                  $diciplina=' de '.$disciplina_anterior->vc_disciplina.' para '.$disciplina_actual->vc_disciplina; 
                  
                //   if($disciplina_anterior->vc_imagem!=$disciplina_actual->vc_imagem)
                //   $imagem=' e nome da sua imagem de '.$disciplina_anterior->vc_imagem.' para '.$disciplina_anterior->vc_imagem; 
                  $complemento= $diciplina;//.$imagem;
                    $this->Logger->Log('info', 'Actualizou a disciplina '.$complemento);
                    return redirect()->route('disciplinas')->with('status', 1);
                }
            }


            return redirect()->back()->with('has', 1);
       }
    }

    public function eliminar($id)
    {
        Disciplina::find($id)->update(['it_estado' => 0]);
        $this->Logger->Log('info', 'Eliminou Disciplina');
        $this->Logger->Log('info', 'Eliminou a disciplina de '.Disciplina::find($id)->vc_disciplina);
        return redirect()->back()->with('eliminar', 1);
        //return redirect()->route('disciplinas');
    }
}
