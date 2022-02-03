<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Models\Dias_semanas;
use App\Models\Hora;
class DiasSemanasController extends Controller
{
    private $Logger;
    public function __construct()
    {
        $this->Logger = new Logger();
    }
    public function index()
    {
        $response['dias_semanas']= Dias_semanas::where('it_estado',1)->get();
        return view('admin.dias_semanas.index', $response);
    }

    public function create()
    {
         $response['dias_semanas']= Dias_semanas::where( 'it_estado', 1 )->get();;
    return view('admin.dias_semanas.criar.index', $response);
    }

    public function store(Request $request)
    {
        
            Dias_semanas::create([
                'vc_dia'=>$request->dia,
                
                ]);
                $this->Logger->Log('info','Adicionou Dia de Semana');
                return redirect()->back()->with('status', 1);
      
       
    }

    public function edit($id)
    {
        $Response['dias_semanas'] =  Hora::find($id);
        return view('admin.dias_semanas.editar.index', $Response);
    }

    public function update(Request $request, $id)
    {
        Dias_semanas::find($id)->update([
            'vc_dia'=>$request->dia,
           
    ]);
    $this->Logger->Log('info','Actualizou Dia de Semana');
        return redirect()->route('dias_semanas.index')->with('status', 1);
    }

    public function delete($id)
    {
        
     Dias_semanas::find($id)->update(['it_estado'=>0]);

        $this->Logger->Log('info','Eliminou Dia de Semana');
        return redirect()->back();
    }
}
