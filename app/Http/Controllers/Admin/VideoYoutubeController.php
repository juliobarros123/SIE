<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logger;
use App\Models\VideoYoutube;
use Illuminate\Support\Facades\DB;
class VideoYoutubeController extends Controller
{
    //
    private $Logger;
    public function __construct()
    {
        $this->Logger = new Logger();
    }
    public function listar($id)
    {
       $videos_youtube= DB::table('video_youtubes')
            ->join('materias', 'video_youtubes.id_materia', '=', 'materias.id')
            ->where('video_youtubes.it_estado',1)
            ->where('materias.id',$id)
            ->select('video_youtubes.id as id_video','video_youtubes.*','materias.*','materias.id as id_materia')
            ->get();
     
        return view('admin.materia.video_youtube.index',compact('videos_youtube'));
    }

    public function adicionar($id_materia)
    {
        return view('admin.materia.video_youtube.criar.index', compact('id_materia'));
    }


    public function cadastrar(Request $request, $id_materia)
    {


        $resultSet =  VideoYoutube::create([
            'vc_descricao' => $request->vc_descricao,
            'vc_link' => $request->vc_link,
            'id_materia' => $id_materia
        ]);
        if ($resultSet) {
            $this->Logger->Log('info', 'Adicionou um vídeo novo do youtube na matéria com id=' . $id_materia);
            return redirect()->back()->with('status', 1);
        } else {
            return redirect()->back()->with('error', 1);
        }
    }

    public function editar($id)
    {
        $video_youtube =  VideoYoutube::find($id);
        return view('admin.materia.video_youtube.editar.index', compact('video_youtube'));
    }

    public function actualizar(Request $request, $id)
    {
        VideoYoutube::find($id)->update([
            'vc_descricao' => $request->vc_descricao,
            'vc_link' => $request->vc_link,
        ]);
        $this->Logger->Log('info', 'Actualizou um vídeo  do youtube  com id=' . $id);
        return redirect()->back()->with('status', 1);
    }

    public function eliminar($id)
    {

        VideoYoutube::find($id)->update(['it_estado' => 0]);

        $this->Logger->Log('info', 'Eliminou a vídeo do youtube com id ' . $id);
        return redirect()->back();
    }
}
