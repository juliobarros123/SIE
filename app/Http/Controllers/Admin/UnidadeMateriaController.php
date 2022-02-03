<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Logger;
use App\Models\UnidadeMateria;
use Illuminate\Http\Request;

class UnidadeMateriaController extends Controller
{
    //

    private $Logger;
    private $unidades1;
    public function __construct()
    {
        // $this->unidades1 = new MenuController();
        $this->Logger = new Logger();
    }
    public function index()
    {

        $unidades = UnidadeMateria::all();
        return view('admin.unidade.index', compact('unidades'));
    }

    public function criar()
    {

        return view('admin.unidade.criar.index');
    }

    public function cadastrar(Request $unidade)
    {

        $estado = $this->vrf_unidade_existente($unidade->vc_unidade);
        if (!$estado) {

            UnidadeMateria::create(
                [
                    'vc_unidade' => $unidade->vc_unidade

                ]
            );

            $this->Logger->Log('info', 'Adicionou a unidade de ' . $unidade->vc_unidade . ' ao sistema');
            return redirect()->back()->with('status', 1);

        } else {
            return redirect()->back()->with('has', 1);
        }
    }

    public function vrf_unidade_existente($vc_unidade)
    {
        return UnidadeMateria::where('vc_unidade', $vc_unidade)->count();
    }

    public function editar($id)
    {
        $unidade = UnidadeMateria::find($id);
        return view('admin.unidade.editar.index', compact('unidade'));

    }

    public function actualizar(Request $unidade, $id)
    {

        $estado = $this->vrf_unidade_existente($unidade->vc_unidade);
 
        if (!$estado) {

            $unidadeAnterior=UnidadeMateria::find($id);
    
                   $s= UnidadeMateria::find($id)->update([
                        'vc_unidade' => $unidade->vc_unidade 

                    ]);
           
                    $this->Logger->Log('info', 'Actualizou a unidade ' . $unidadeAnterior->vc_unidade.' para '. $unidade->vc_unidade);
                    return redirect()->route('unidades')->with('status', 1);
             
        } else {

            return redirect()->back()->with('has', 1);
        }
    }

    public function eliminar($id)
    {
        $this->Logger->Log('info', 'Eliminou unidade de matéria');
        $this->Logger->Log('info', 'Eliminou a matéria de ' . UnidadeMateria::find($id)->vc_unidade);
        UnidadeMateria::find($id)->delete();

        return redirect()->back()->with('eliminar', 1);
        //return redirect()->route('unidades');
    }
}
