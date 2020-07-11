<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailFaleConosco extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $titulo;
    public $mensagem;
    public $usuario;
    public function __construct($titulo, $mensagem, $usuario)
    {
         $this->titulo = $titulo;
         $this->mensagem = $mensagem;
         $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from('to@email.com')
        ->subject('Fale Conosco do Diztribui')
                ->view('emails.fale-conosco')
                ->with([
                    'titulo' => $this->titulo,
                    'mensagem' => $this->mensagem,
                    'usuario'=>$this->usuario,
                ]);

    }
}
