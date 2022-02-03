<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Models\Hora;
class HorasController extends Controller
{
    private $Logger;
    public function __construct()
    {
        $this->Logger = new Logger();
    }
    public function index()
    {
        $response['horas']= Hora::where('it_estado',1)->get();
        return view('admin.horas.index', $response);
    }

    public function create()
    {
         $response['horas']= Hora::where( 'it_estado', 1 )->get();;
    return view('admin.horas.criar.index', $response);
    }

    public function store(Request $request)
    {
        
        if($request->inicio<$request->fim)
        {
            Hora::create([
                'vc_hora_inicio'=>$request->inicio,
                'vc_hora_fim'=>$request->fim,
                ]);
                $this->Logger->Log('info','Adicionou uma hora ao sistema, que vai das '.$request->inicio.'até às '.$request->fim);
                return redirect()->back()->with('status', 1);
        }else{
            return redirect()->back()->with('aviso', 1);
        }
       
    }

    public function edit($id)
    {
        $Response['horas'] =  Hora::find($id);
        return view('admin.horas.editar.index', $Response);
    }

    public function update(Request $request, $id)
    {
        Hora::find($id)->update([
            'vc_hora_inicio'=>$request->inicio,
            'vc_hora_fim'=>$request->fim,
    ]);
    $this->Logger->Log('info','Actualizou a hora de id '.$id);
        return redirect()->route('horas.index')->with('status', 1);
    }

    public function delete($id)
    {
        
       $t= Hora::find($id)->update(['it_estado'=>0]);

        $this->Logger->Log('info','Eliminou a hora de id '.$id);
        return redirect()->back();
    }
}
