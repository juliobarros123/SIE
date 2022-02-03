<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response ;
use App\Models\ReacaoVideo;
use Illuminate\Support\Facades\Auth;

class ReacaoVideoController extends Controller
{
    //

    public function gostei(Request $recao, $id_video)
    {
        // return "ola";
        // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        $reacao=   ReacaoVideo::where('id_video', $id_video)->where('id_user', Auth::id())->count();

        if ($reacao) {
            if (ReacaoVideo::where('id_video', $id_video)->where('reacao', 'nao gostei')->where('id_user', Auth::id())->count()) {
                ReacaoVideo::where('id_video', $id_video)->where('reacao', 'nao gostei')->where('id_user', Auth::id())->delete();
            }

            if (ReacaoVideo::where('id_video', $id_video)->where('reacao', 'gostei')->where('id_user', Auth::id())->count()) {
                ReacaoVideo::where('id_video', $id_video)->where('reacao', 'gostei')->where('id_user', Auth::id())->delete();
               
            } else {
                ReacaoVideo::create(
                    [
                                'reacao'=>"gostei",
                                'id_video'=>$id_video,
                                'id_user'=>Auth::id()
                            ]
                );
            }
        } else {
            ReacaoVideo::create(
                [
                        'reacao'=>"gostei",
                        'id_video'=>$id_video,
                        'id_user'=>Auth::id()
                    ]
            );
        }
        $ttl_gosto= $this->contar_gosto($id_video);
        $ttl_nao_gosto= $this->contar_nao_gosto($id_video);


        return response()->json(['ttl_gosto'=>$ttl_gosto,'ttl_nao_gosto'=>$ttl_nao_gosto]);
    }

    public function nao_gostei(Request $recao, $id_video)
    {
   
        // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
        $reacao=   ReacaoVideo::where('id_video', $id_video)->where('id_user', Auth::id())->count();

        if ($reacao) {
            if (ReacaoVideo::where('id_video', $id_video)->where('reacao', 'gostei')->where('id_user', Auth::id())->count()) {
                ReacaoVideo::where('id_video', $id_video)->where('reacao', 'gostei')->where('id_user', Auth::id())->delete();
               
            }

            if (ReacaoVideo::where('id_video', $id_video)->where('reacao', 'nao gostei')->where('id_user', Auth::id())->count()) {
                ReacaoVideo::where('id_video', $id_video)->where('reacao', 'nao gostei')->where('id_user', Auth::id())->delete();
               
            } else {
                ReacaoVideo::create(
                    [
                                'reacao'=>"nao gostei",
                                'id_video'=>$id_video,
                                'id_user'=>Auth::id()
                            ]
                );
            }
        } else {
            ReacaoVideo::create(
                [
                        'reacao'=>"nao gostei",
                        'id_video'=>$id_video,
                        'id_user'=>Auth::id()
                    ]
            );
        }

        $ttl_gosto= $this->contar_gosto($id_video);
        $ttl_nao_gosto= $this->contar_nao_gosto($id_video);
        return response()->json(['ttl_gosto'=>$ttl_gosto,'ttl_nao_gosto'=>$ttl_nao_gosto]);
    }

    public function contar_gosto($id_video)
    {
        return ReacaoVideo::where('id_video', $id_video)->where('reacao', 'gostei')->count();
    }

    public function contar_nao_gosto($id_video)
    {
        return ReacaoVideo::where('id_video', $id_video)->where('reacao', 'nao gostei')->count();
    }
}
