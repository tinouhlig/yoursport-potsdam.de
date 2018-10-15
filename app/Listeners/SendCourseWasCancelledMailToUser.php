<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Yours\Events\CourseWasCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCourseWasCancelledMailToUser
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
     * @param  CourseWasCancelled  $event
     * @return void
     */
    public function handle(CourseWasCancelled $event)
    {
        $actualSignedOutCourse = $event->user->nachholkurse()->gueltig()->orderBy('created_at', 'desc')->first();

        $allNachholkurse = $event->user->nachholkurse()->gueltig()->get();

        $this->mailer->send('mail.kursabmeldung.kursWurdeAbgesagtUser',
                            [
                                'user' => $event->user,
                                'actualSignedOutCourse' => $actualSignedOutCourse,
                                'allNachholkurse' => $allNachholkurse,
                                'coursedate' => $event->coursedate,
                            ],
                            function ($message) use ($event) {
            
            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to($event->user->email, $event->user->fullname)->subject('Du wurdest abgemeldet.');

        });
    }
}
