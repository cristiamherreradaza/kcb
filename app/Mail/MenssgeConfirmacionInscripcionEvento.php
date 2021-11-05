<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MenssgeConfirmacionInscripcionEvento extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Mensaje de Confirmacion al Evento";

    public $datosR;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datosE)
    {
        $this->datosR = $datosE;
        // dd($datosE. "<----->".$this->datosR);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.message-confirmacion-inscripcion-evento');
    }
}
