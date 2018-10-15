<?php

namespace Yours\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Yours\Events\UserSignedOutFromCourse' => [
            'Yours\Listeners\SendSignedOutFromCourseMailtoUser',
            'Yours\Listeners\SendSignedOutFromCourseMailtoAdmin',
            //'Yours\Listeners\SendSignedOutFromCourseMailtoTrainer',
        ],
        'Yours\Events\UserSignedInToUseNachholkurs' => [
            'Yours\Listeners\UserSignedInToUseNachholkursMailToUser',
            'Yours\Listeners\UserSignedInToUseNachholkursMailToAdmin',
        ],
        'Yours\Events\UserWasRegisteredByAdmin' => [
            'Yours\Listeners\SendUserWasRegisteredByAdminMailToUser',
        ],
        'Yours\Events\CourseWasCancelled' => [
            'Yours\Listeners\SendCourseWasCancelledMailToUser',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
