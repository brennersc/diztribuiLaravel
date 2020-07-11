<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $senha;
    public $usuario;
    public function __construct($senha, $usuario)
    {
         $this->senha = $senha;
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
        ->subject('Bem vindo ao Diztribui')
                ->view('emails.usuario')
                ->with([
                    'senha' => $this->senha,
                    'usuario'=>$this->usuario,
                ]);

    }
}
