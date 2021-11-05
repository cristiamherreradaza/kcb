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
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this-> id = id ;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.message-confirmacion-inscripcion-evento')->with(compact());
    }
}
