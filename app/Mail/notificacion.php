<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificacion extends Mailable
{
    use Queueable, SerializesModels;

    private $correo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correo, $titulo, $descripcion, $logo)
    {

        $this->correo       = $correo;
        $this->titulo       = $titulo;
        $this->descripcion  = $descripcion;
        $this->logo         = $logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $vars = [
            'correo'        => $this->correo,
            'titulo'        => $this->titulo,
            'descripcion'   => $this->descripcion,
            'logo'          => $this->logo
        ];

        return $this->view('correos.notificacion', $vars);
    }
}
