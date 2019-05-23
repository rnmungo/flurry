<?php

namespace Flurry\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;

    public $latitude;
    public $longitude;
    public $address;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->latitude = $request->input('latitude');
        $this->longitude = $request->input('longitude');
        $this->address = $request->input('address');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Alerta de Inicio de Sesión - ".config('app.name', 'Flurry'))->view('mails.login-alert');
    }
}
