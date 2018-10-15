<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Yours\Events\UserSignedOutFromCourse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendSignedOutFromCourseMailtoAdmin
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
        $actualSignedOutCourse = $event->user->nachholkurse()->gueltig()->orderBy('created_at', 'desc')->first();
                            
        $allSignedOutCourses = $event->user->nachholkurse()->gueltig()->get();

        $this->mailer->send('mail.kursabmeldung.kursabmeldungAdmin',
                            [
                                'user' => $event->user,
                                'actualSignedOutCourse' => $actualSignedOutCourse,
                                'coursedate' => $event->coursedate,
                                'gueltige_abmeldung' => $event->gueltige_abmeldung ,
                            ],
                            function ($message) use ($event) {
            
            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to('info@yoursport-potsdam.de', 'Yours Potsdam')->subject('Kursabmeldung von ' . $event->user->fullname);

        });
    }
}
