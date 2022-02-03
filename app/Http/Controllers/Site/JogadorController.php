<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jogador;

class JogadorController extends Controller
{
    //

    public function criar(){
      return  view('site.jogador.criar.index');
    }

    public function cadastrar(Request $jogador){
    //   $result_jogador=Jogador::create($jogador->all());
      session()->forget('jogador');
      $this->createSession($jogador);
      return redirect()->route('quizz.disciplinas');
    }

    public function createSession($jogador){
        $jogador->session()->put('jogador', [
            [
                'product_id'     => 1,
                'nome'             => $jogador->nome_jogador,
            ]
        ]
        );
    }

}
