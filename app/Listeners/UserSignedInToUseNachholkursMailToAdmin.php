<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Yours\Events\UserSignedInToUseNachholkurs;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserSignedInToUseNachholkursMailToAdmin
{
    public $mailer;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserSignedInToUseNachholkurs  $event
     * @return void
     */
    public function handle(UserSignedInToUseNachholkurs $event)
    {
            $this->mailer->send('mail.kursanmeldung.kursanmeldungAdmin',
                            [
                                'user' => $event->user,
                                'coursedate' => $event->coursedate
                            ],
                            function ($message) use ($event) {
            
            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to('info@yoursport-potsdam.de', 'Yours Potsdam')->subject("Kursanmeldung von " . $event->user->fullname);

        });
    }
}
