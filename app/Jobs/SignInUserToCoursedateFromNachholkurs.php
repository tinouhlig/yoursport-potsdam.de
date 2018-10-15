<?php

namespace Yours\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Yours\Events\UserSignedInToUseNachholkurs;
use Yours\Jobs\Job;
use Yours\Models\Coursedate;

class SignInUserToCoursedateFromNachholkurs extends Job implements SelfHandling
{
    protected $user;
    protected $coursedate_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $coursedate_id)
    {
        $this->user = $user;
        $this->coursedate_id = $coursedate_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $nextNachholkurs = $this->user->nachholkurse()->gueltig()->get()->sortBy('gueltig_bis')->first();
        $nextNachholkurs->status = 'used';
        $nextNachholkurs->signedInCoursedate = $this->coursedate_id;
        $nextNachholkurs->save();
        
        $this->user->coursedate()->attach($this->coursedate_id, ['status' => 'nachholkurs']);

        event( new UserSignedInToUseNachholkurs($this->user, Coursedate::find($this->coursedate_id)) );
    }
}
