<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Yours\Events\UserSignedInToUseNachholkurs;

class UserSignedInToUseNachholkursMailToUser
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
        $this->mailer->send('mail.kursanmeldung.kursanmeldungUser',
                            [
                                'user' => $event->user,
                                'coursedate' => $event->coursedate
                            ],
                            function ($message) use ($event) {
            
            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to($event->user->email, $event->user->fullname)->subject('Kursanmeldung bestätigt');

        });
    }
}
