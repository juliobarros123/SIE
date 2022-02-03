<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempoSessao;
use App\Models\Logger;
class TempoSessaoController extends Controller
{
    //

    //
    private $Logger;

    public function __construct()
    {
        $this->Logger = new Logger();
    }

    public function  listar()
    {
      $tempos_sessao=  TempoSessao::all();
      return view('admin.tempo_sessao.index', compact('tempos_sessao'));
    }

    public function criar()
    {
        return view('admin.tempo_sessao.criar.index');
    }
    public function cadastrar(Request $tempos){
      if ($tempos->tempo_contagem<$tempos->tempo_termino) {
          TempoSessao::create($tempos->all());
          $this->Logger->Log('info', 'Cadastrou Tempo de Término de Sessão ');
          return redirect()->route('tempo_sessao')->with('status', 1);
      }else{
        return redirect()->back()->with('error', 1);
      }
    }

    public function editar($id){
      $tempo_sessao=  TempoSessao::find($id);
      return view('admin.tempo_sessao.editar.index',compact('tempo_sessao'));
      
    }

    public function actualizar(Request $tempos,$id){
       TempoSessao::find($id)->update($tempos->all());
       $this->Logger->Log('info', 'Editou Tempo de Término de Sessão '.$id);
        return redirect()->route('tempo_sessao')->with('up', 1);
      }

      public function eliminar($id){
        TempoSessao::find($id)->delete();
        $this->Logger->Log('info', 'Eliminou Tempo de Término de Sessão '.$id);
         return redirect()->route('tempo_sessao')->with('delete', 1);
       }
}
