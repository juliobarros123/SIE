<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\CorrespondenciaXilonga;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

class CorrespondenciaXilongaController extends Controller
{
   public function  __construct(){}

   public function enviar(Request $req)
   {
       //dd($req->email);
    Mail::to("mensagemxilonga21@gmail.com")->send(new CorrespondenciaXilonga($req->email,$req->vc_mensagem,$req->vc_nome,$req->vc_apelido,$req->vc_telefone));
    $email="mensagemxilonga21@gmail.com";
    $vc_mensagem="Sr(a) ".$req->vc_nome." ".$req->vc_apelido." a sua mensagem foi enviada com sucesso!";
   
    Mail::to($req->email)->send(new CorrespondenciaXilonga($email,$vc_mensagem, $req->vc_nome,$req->vc_apelido,null));
    return redirect()->back();
   }

   public function trazerFormulario(){
      return view('site.forms._formEmail.index');
   }
}
