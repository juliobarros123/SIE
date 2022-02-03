<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Questao_Quiz;
use App\Models\Resposta_Quiz;
class RespostaQuestaoQuiz extends Controller
{
    //
    public function respostas($slug){
        $response['questao']=  Questao_Quiz::where('slug',$slug)->first();
        $response['respostas']=Resposta_Quiz::where('id_questao',$response['questao']->id)->get();
    return view('admin.quiz.questao.respostas.index', $response);
    }
    public function editar($slug){
        // dd($slug);
        $response['resposta']= Resposta_Quiz::where('slug',$slug)->first();
    //    dd( $resposta);
       return view('admin.quiz.questao.respostas.editar.index', $response);

    }
    public function editar_file($slug){
        // dd($slug);
        $response['resposta']= Resposta_Quiz::where('slug',$slug)->first();
    //    dd( $resposta);
       return view('admin.quiz.questao.respostas.editar.index_file', $response);

    }
    
    public function actualizar(Request $request, $slug)
    {
        // dd($request);
        // dd(   Questao_Quiz::where('slug', $slug)->get());
        // dd( $request);
      $estado=  Resposta_Quiz::where('slug', $slug)->update([
            'resposta' => $request->resposta
            
        ]);

        return redirect()->back()->with('actualizado_geral', 1);
    }
    public function actualizar_file(Request $request, $slug)
    {
      $caminho=  $this->uploadImg($request->resposta);
      $estado=  Resposta_Quiz::where('slug', $slug)->update([
            'resposta' => $caminho
            
        ]);
// dd( $estado);
        return redirect()->back()->with('actualizado_geral', 1);
    }

    public function uploadImg($coluna)
    {
        // Verifica se informou o arquivo e se é válid
        // Define um aleatório para o arquivo baseado no timestamps atual
        $name = uniqid(date('HisYmd'));

        // Recupera a extensão do arquivo
        $extension = $coluna->extension();

        // Define finalmente o nome
        $nameFile = "{$name}.{$extension}";

        // Faz o upload:
        $upload = $coluna->storeAs('public/quiz/repostas/file', $nameFile);
        $upload = substr( $upload ,7,strlen($upload));
        // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

        // Verifica se NÃO deu certo o upload ( Redireciona de volta )
        if (!$upload) {
            return redirect()
                ->back()
                ->with('error', 'Falha ao fazer upload')
                ->withInput();
        } else {
            return $upload;

        }

    }
   
}
