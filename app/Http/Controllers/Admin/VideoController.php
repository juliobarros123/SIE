<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Logger;
class VideoController extends Controller
{
   
    public function create(){
        $video = Video::all();
        return view('admin.video.criar.index');
    }

    public function uploadVideo(Request $request, $id){

        Video::create([
            'vc_nameVideo'=>$request->vc_nameVideo,
            'vc_endereco'=>$request->vc_endereco,
            'vc_descricao'=>$request->vc_descricao
        ]);

        if($request->hasFile('vc_endereco')) {
            $video = $request->file('vc_endereco');
            $num = rand(1111, 9999);
            $dir = "video/Aula";
            $extensao = $video->guessClientExtension();
            $nomeVideo ='vc_endereco'."_" . $num . "." . $extensao;
            $video->move($dir, $nomeVideo);
            $dados['vc_endereco'] = $dir . "/" . $nomeVideo;
            $videoAula = Video::find($id);
            unlink($videoAula->vc_endereco);

            return "Video insirido com sucesso";
        }
        else{
            return "Video não inserido";
        }

        return view('admin.video.criar.index');

    }


}
