<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Activar extends Mailable
{
    use Queueable, SerializesModels;

    private $correo;
    private $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $token)
    {
        
        $this->correo = $correo;
        $this->token  = $token;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $vars = [
            'correo' => $this->correo,
            'token'  => $this->token,
        ];

        return $this->view('correos.activar', $vars);
    }
}
