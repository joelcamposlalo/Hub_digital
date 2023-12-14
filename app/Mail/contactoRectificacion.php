<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class contactoRectificacion extends Mailable
{
    use Queueable, SerializesModels;

    private $correoData;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correoData, $document_urls)
    {
        $this->correoData = $correoData;
        $this->document_urls = $document_urls;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correos.solicitudRectificacion')
            ->subject('Solicitud para Rectificación de Trámite web de rectificación de nombre, domicilio y ubicación')
            ->with([
                'correoData' => $this->correoData,
                'document_urls' => $this->document_urls,
            ]);
    }
}




