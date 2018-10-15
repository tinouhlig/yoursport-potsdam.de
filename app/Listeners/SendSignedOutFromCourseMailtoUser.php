<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Yours\Events\UserSignedOutFromCourse;

class SendSignedOutFromCourseMailtoUser
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
     * @param  UserSignedOutFromCourse  $event
     * @return void
     */
    public function handle(UserSignedOutFromCourse $event)
    {
        $actualSignedOutCourse = false;
        if ( $event->gueltige_abmeldung ) {
            $actualSignedOutCourse = $event->user->nachholkurse()->gueltig()->orderBy('created_at', 'desc')->first();
        }

        $allNachholkurse = $event->user->nachholkurse()->gueltig()->get();

        $this->mailer->send('mail.kursabmeldung.kursabmeldungUser',
                            [
                                'user' => $event->user,
                                'actualSignedOutCourse' => $actualSignedOutCourse,
                                'allNachholkurse' => $allNachholkurse,
                                'coursedate' => $event->coursedate,
                                'gueltige_abmeldung' => $event->gueltige_abmeldung ,
                            ],
                            function ($message) use ($event) {
            
            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to($event->user->email, $event->user->fullname)->subject('Kursabmeldung bestätigt');

        });
    }
}
