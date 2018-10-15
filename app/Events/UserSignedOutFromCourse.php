<?php

namespace Yours\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Yours\Events\Event;
use Yours\Models\Coursedate;
use Yours\Models\User;

class UserSignedOutFromCourse extends Event
{
    use SerializesModels;

    public $user;

    public $coursedate;

    public $gueltige_abmeldung;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Coursedate $coursedate, $gueltige_abmeldung)
    {
        $this->user = $user;
        $this->coursedate = $coursedate;
        $this->gueltige_abmeldung = $gueltige_abmeldung;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
