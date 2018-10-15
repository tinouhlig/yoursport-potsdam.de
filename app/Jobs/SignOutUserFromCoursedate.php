<?php

namespace Yours\Jobs;

use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
use Yours\Events\CourseWasCancelled;
use Yours\Events\UserSignedOutFromCourse;
use Yours\Jobs\Job;
use Yours\Models\Coursedate;
use Yours\Models\Nachholkurs;
use Yours\Models\User;

class SignOutUserFromCoursedate extends Job implements SelfHandling
{
    private $user;
    private $coursedate;
    private $admin_abmeldung;
    private $gueltige_abmeldung;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Coursedate $coursedate, $admin_abmeldung = false)
    {
        $this->user = $user;
        $this->coursedate = $coursedate;
        $this->admin_abmeldung = $admin_abmeldung;
        $this->gueltige_abmeldung = false;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->user->role == 'Neukunde') {
            $this->user->coursedate()->detach($this->coursedate->id);
            return;
        }

        if (!(Carbon::now() > $this->coursedate->sign_out_time) || $this->gueltige_abmeldung || $this->admin_abmeldung) {
            $this->gueltige_abmeldung = true;
            $this->createNachholkurs();
        }
        
        $this->user->coursedate()->detach($this->coursedate->id);

        if ($this->admin_abmeldung) {
            event(new CourseWasCancelled($this->user, $this->coursedate));
        } else {
            event(new UserSignedOutFromCourse($this->user, $this->coursedate, $this->gueltige_abmeldung));
        }
    }

    private function createNachholkurs()
    {
        if ($this->coursedate->pivot->status == "nachholkurs") {
            $this->createNachholkursForNachholkursabmeldung();
            return;
        }

        $user_price = $this->user->all_prices->filter(function ($item) {
            return $item->id == $this->user->course()->find($this->coursedate->course->id)->pivot->price_user_id;
        })->first();
        
        if (!is_null($user_price)) {
            if ($user_price->price->duration_type == 'weeks') {
                $this->createNachholkursForWeeklyContract($user_price);
                return;
            }
        }

        $gueltig_bis = Carbon::parse($this->coursedate->date)->addDays(14)->format('Y-m-d');

        Nachholkurs::create([
            'gueltig_bis' => $gueltig_bis,
            'user_id' => $this->user->id,
            'signedOutCoursedate' => $this->coursedate->id,
        ]);
    }

    private function createNachholkursForWeeklyContract($user_price)
    {
        if ($this->admin_abmeldung) {
            $gueltig_bis = $user_price->expire_at > Carbon::parse($this->coursedate->date)->addDays(14) ? $user_price->expire_at : Carbon::parse($this->coursedate->date)->addDays(14);
        } else {
            $gueltig_bis = $user_price->expire_at;
        }

        Nachholkurs::create([
            'gueltig_bis' => $gueltig_bis,
            'user_id' => $this->user->id,
            'signedOutCoursedate' => $this->coursedate->id,
        ]);
        return;
    }

    private function createNachholkursForNachholkursabmeldung()
    {
        $nachholkurs = Nachholkurs::whereHas('signedInCoursedate', function ($query) {
            $query->where('id', $this->coursedate->id);
        })->get()->first();

        $nachholkurs->status = 'not used';

        if ($this->admin_abmeldung) {
            $nachholkurs->gueltig_bis = Carbon::parse($this->coursedate->date)->addDays(14)->format('Y-m-d');
        }

        $this->gueltige_abmeldung = $nachholkurs->gueltig_bis > Carbon::now() ? true : false;

        $nachholkurs->save();
        return;
    }
}
