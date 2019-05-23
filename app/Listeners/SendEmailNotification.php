<?php

namespace Flurry\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Flurry\Mail\LoginMail;
use Carbon\Carbon;
use Cookie;

class SendEmailNotification
{
    protected $request;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        /**
         * Se guarda una Cookie con 10 días de vencimiento para que no
         * envíe mail de alerta de inicio de sesión por un tiempo
         * prolongado. Una vez expire esto, se vuelve a enviar el mail.
         * Esto se hace por cada usuario.
         */
        $user_due_date = Cookie::get(str_replace(' ', '_', $event->user->name).'_session_due_date');
        if ((!$user_due_date) || ($user_due_date && Carbon::parse($user_due_date)->diffInDays(Carbon::now()) >= 10)) {
            Cookie::queue(Cookie::make(str_replace(' ', '_', $event->user->name).'_session_due_date', Carbon::now(), 10 * 24 * 60));
            Mail::to($event->user)->send(new LoginMail($this->request));
        }
    }
}
