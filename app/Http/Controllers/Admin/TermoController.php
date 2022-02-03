<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Models\Termo;
class TermoController extends Controller
{
    //

    
    private $Logger;
    private $termos1;
    public function __construct()
    {
        // $this->termos1 = new MenuController();
        $this->Logger = new Logger();
    }
    public function index()
    {

        $termos = Termo::all();
        return view('admin.termo.index', compact('termos'));
    }

    public function criar()
    {

        return view('admin.termo.criar.index');
    }

    public function cadastrar(Request $termo)
    {

        $estado = $this->vrf_termo_existente($termo);
        if (!$estado) {

            Termo::create($termo->all() );

            $this->Logger->Log('info', 'Adicionou a termo de ' . $termo->tipoUtilizador . ' ao sistema');
            return redirect()->back()->with('status', 1);

        } else {
            return redirect()->back()->with('has', 1);
        }
    }

    public function vrf_termo_existente($termo)
    {
        $termo=$termo->except(['_token','_method']);
    
        return Termo::where($termo)->count();
    }

    public function editar($id)
    {
        $termo = Termo::find($id);
        return view('admin.termo.editar.index', compact('termo'));

    }

    public function actualizar(Request $termo, $id)
    {

        $estado = $this->vrf_termo_existente($termo);
 
        if (!$estado) {

            $termoAnterior=Termo::find($id);
    
                   $s= Termo::find($id)->update( $termo->all());
           
                    $this->Logger->Log('info', 'Actualizou a termo ' . $termo->tipoUtilizador.' para '. $termo->tipoUtilizador);
                    return redirect()->route('termos')->with('status', 1);
             
        } else {

            return redirect()->back()->with('has', 1);
        }
    }

    public function eliminar($id)
    {

        $this->Logger->Log('info', 'Eliminou termo de tipo de utilizador ' . Termo::find($id)->tipoUtilizador);
        Termo::find($id)->delete();

        return redirect()->back()->with('eliminar', 1);
        //return redirect()->route('termos');
    }
}
