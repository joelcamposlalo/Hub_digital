<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class contactoCapacitacion extends Mailable
{
    use Queueable, SerializesModels;

    private $correoData;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($correoData)
    {
        $this->correoData = $correoData;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

       return $this->view('correos.solicitudCapacitacion')
                ->subject('Capacitación Protección Civil y Bomberos')
                ->with([
                    'correoData' => $this->correoData['data_p'],
                    'participantes' => $this->correoData['data_participantes'],
                ]);
    }
}
