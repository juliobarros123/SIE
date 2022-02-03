<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CorrespondenciaXilonga extends Mailable
{
    use Queueable, SerializesModels;
    public $assunto,$caminho_view_mensagem,$email,$vc_mensagem,$vc_nome,$vc_apelido,$vc_telefone;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$vc_mensagem,$vc_nome,$vc_apelido,$vc_telefone)
    {
        //
        $this->caminho_view_mensagem="email.utilizador_xilonga.index";
        $this->email=$email;
        $this->vc_nome=$vc_nome;
        $this->vc_apelido=$vc_apelido;
        $this->vc_mensagem=$vc_mensagem;
        $this->vc_telefone=$vc_telefone;
        $this->assunto="Mensagem de um utilizador do Xilonga";
        if (!$vc_telefone){
            $this->assunto="Mensagem de Confirmação";
            $this->caminho_view_mensagem="email.xilonga_confirmacao.index";
        }
        

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $this->from($this->email)
         ->subject($this->assunto)
        ->markdown($this->caminho_view_mensagem)
        ->text($this->caminho_view_mensagem,[
            'email'=>$this->email,
            'vc_nome'=>$this->vc_nome,
            'vc_apelido'=>$this->vc_apelido,
            'vc_mensagem'=>$this->vc_mensagem,
            'vc_telefone'=>$this->vc_telefone
        ]);

    }

    /*public function reenviar($email){

        $this->from($this->email)
        ->view('email.index')
        ->text("email.index",[
            'email'=>$this->email,
            'vc_mensagem'=>$this->vc_mensagem,
        ]);
    }*/
    
}
