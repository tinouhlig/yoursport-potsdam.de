<?php

namespace Yours\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Yours\Events\Event;
use Yours\Models\Coursedate;
use Yours\Models\User;

class CourseWasCancelled extends Event
{
    use SerializesModels;

    public $user;

    public $coursedate;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Coursedate $coursedate)
    {
        $this->user = $user;
        $this->coursedate = $coursedate;
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
