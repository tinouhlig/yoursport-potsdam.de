<?php

namespace Yours\Listeners;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Yours\Events\UserWasRegisteredByAdmin;

class SendUserWasRegisteredByAdminMailToUser
{

    protected $mailer;
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
     * @param  UserWasRegisteredByAdmin  $event
     * @return void
     */
    public function handle(UserWasRegisteredByAdmin $event)
    {
        $this->mailer->send('mail.auth.registeredByAdmin', [ 'user' => $event->user, 'password' => $event->password ], function ($message) use ($event) {
            
            $message->attach(storage_path('app').'/AGB Studio YOURS 2016.pdf');

            $message->from('info@yoursport-potsdam.de', 'Yours Potsdam');

            $message->to($event->user->email, $event->user->fullname)->subject('Sie wurden registriert');

        });
    }
}
