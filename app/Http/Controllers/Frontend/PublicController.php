<?php

namespace Yours\Http\Controllers\Frontend;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use Session;
use Validator;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Http\Requests\SendKontaktRequest;
use Yours\Http\Requests\SendKursanmeldungRequest;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Yours\Models\Coursetype;

class PublicController extends Controller
{

    public function getHome(Request $r)
    {
        $showCTA = true;
        if (Session::has('user_active')) {
            $showCTA = false;
        }
        Session::put('user_active', true);

        return view('public.pages.home', compact('showCTA'));
    }


    public function postKontakt(SendKontaktRequest $request)
    {
        Mail::send('mail.kontakt', ['data' => $request->all()], function ($m) use ($request) {
            $m->to('info@yoursport-potsdam.de')
                ->from($request->input('email_kontakt'))
                ->subject($request->input('subject'));
        });

        flash()->success('Ihre Nachricht wurde versandt');

        return redirect()->route('home');
    }

    public function postKursanmeldung(SendKursanmeldungRequest $request)
    {
        $data = $request->only([ 'email', 'message' ]);
        $data['course'] = Course::findOrFail($request->course_id);
        $data['message'] = ($data['message'] == '' ? 'keine Nachricht hinterlassen' : $data['message']);
        $data['subject'] = "Kursanfrage " . $data['course']->coursetype->name . " " .$data['course']->day. " " .$data['course']->time;

        Mail::send('mail.kursanmeldung', ['data' => $data], function ($m) use ($data) {
            $m->to('info@yoursport-potsdam.de')
                ->from($data['email'])
                ->subject($data['subject']);
        });

        flash()->success('Ihre Nachricht wurde versandt');

        return redirect()->back();
    }

    public function postHomeKursanmeldung(Request $request)
    {
        $this->validate($request, [
            'spam_filter' => 'max:0',
            'emailanmeldung' => "required",
        ]);

        $data = $request->only([
                            'emailanmeldung',
                            'messageanmeldung'
                    ]);
        $data['subject'] = 'Kursanmeldung Hypnoseseminar';

        Mail::send('mail.homekursanmeldung', ['data' => $data], function ($m) use ($data) {
            $m->to('info@yoursport-potsdam.de')
                ->from($data['emailanmeldung'])
                ->subject($data['subject']);
        });

        flash()->success('Ihre Nachricht wurde versandt');

        return redirect()->back();
    }

    public function postMassageanfrage(Request $request)
    {
        $this->validate($request, [
            'spam_filter' => 'max:0',
            'email' => "required",
            'massagen' => 'required',
            'dauer' => 'required',
            'message' => 'required'
        ]);

        $data = $request->only([
                            'email',
                            'message',
                            'massagen',
                            'dauer'
                    ]);
        $data['subject'] = 'Anfrage für ' . $data['massagen'];

        Mail::send('mail.massageanfrage', ['data' => $data], function ($m) use ($data) {
            $m->to(['info@yoursport-potsdam.de'])
                ->from($data['email'])
                ->subject($data['subject']);
        });

        flash()->success('Ihre Nachricht wurde versandt');

        return redirect()->back();
    }

    public function getKursplan(Request $request, $year = null, $week = null)
    {
        $startOfWeek = Carbon::now();

        if ($request->isMethod('get')) {
            if (!$week) {
                $week = $startOfWeek->weekOfYear;
            }
            if (!$year) {
                $year = $startOfWeek->year;
            }
        } else {
            $week = $request->input('week');
            $year = $request->input('year');
        }

        $startOfWeek->setISODate($year,$week);

        $weekDayDE = [
            'Monday' => 'Montag',
            'Tuesday' => 'Dienstag',
            'Wednesday' => 'Mittwoch',
            'Thursday' => 'Donnerstag',
            'Friday' => 'Freitag',
            'Saturday' => 'Samstag',
            'Sunday' => 'Sonntag',
        ];

        $coursedates = Coursedate::with('course', 'user')->active()->week($startOfWeek)->get();

        $startTimes = $coursedates->fetch('course')->fetch('time');

        $coursedates = $coursedates->sortBy(function ($coursedate, $key) {
                            return $coursedate->course->time;
                        })->groupBy('date');

        $time = null;
        $minTime = $startTimes->min();
        $gapMargin = 0;
        if (!$coursedates->isEmpty()) {
            # code...
        
        $coursedates->each(function ($courseday) use ($time, $minTime, $request) {
                    foreach ($courseday as $coursedate) {
                        $coursedate->addVisible(['kursbesucher' => false]);
                        if ($request->user()) {
                            $coursedate->user->each(function ($user) use ($request, $coursedate)
                            {
                                if ($user->id == $request->user()->id) {
                                    $coursedate->addVisible(['kursbesucher' => true]);
                                }
                            });
                        }
                        if (!$time) {
                            $time = $coursedate->course->time;
                            if ($time == $minTime) {
                                $coursedate->addVisible(['margin-top' => 0]);
                                continue;
                            } else {
                                $coursedate->addVisible(['margin-top' => $this->getMarginTopForKursplan(Carbon::createFromFormat('H:i:s', $minTime), Carbon::createFromFormat('H:i:s', $time))]);
                                continue;
                            }
                        }
                        $coursedate->addVisible(
                            ['margin-top' => $this->getMarginTopForKursplan(Carbon::createFromFormat('H:i:s', $time), Carbon::createFromFormat('H:i:s', $coursedate->course->time))-90]
                        );
                        $time = $coursedate->course->time;
                    }
                });
        $gapMargin = Carbon::createFromFormat('H:i:s', $minTime)->diffInMinutes(Carbon::createFromFormat('H:i:s', '13:00:00'))*1.5;
        }
        $startOfWeekCopy = clone $startOfWeek;
        $prevWeek = clone $startOfWeek;
        $prevWeek->subWeek();
        $nextWeek = clone $startOfWeek;
        $nextWeek->addWeek()->endOfWeek();

        return view('public.pages.kursplan', compact('coursedates', 'startOfWeek', 'startOfWeekCopy', 'weekDayDE', 'gapMargin', 'prevWeek', 'nextWeek'));
    }

    /**
     * Returns the view for all coursetypes
     * @return mixed view
     */
    public function getKurse()
    {
        $kurse = Coursetype::all();
        return view('public.pages.kurse', compact('kurse'));
    }

    /**
     * Returns the view for a specific coursetypes
     * @return mixed view
     */
    public function getKurs(Coursetype $kurstyp)
    {
        $wochentage = [
            "Montag" => 0,
            "Dienstag" => 1,
            "Mittwoch" => 2,
            "Donnerstag" => 3,
            "Freitag" => 4,
            "Samstag" => 5,
            "Sonntag" => 6,
        ];
        $gruppenkurse = $kurstyp->course->sortBy(function ($course, $key) {
                            return $course->time;
                        })->groupBy('day')->sortBy(function ($courses, $key) use ($wochentage) {
                            return $wochentage[$key];
                        });

        $kurstrainer = $kurstyp->course()->with('trainer')->get()->fetch('trainer')->keyBy('id')->forget("");

        return view('public.pages.kurs', compact('kurstyp', 'gruppenkurse', 'kurstrainer'));
    }



    /**
     * Calculate the Position of the Course in the Coursetable
     * @param  carbon object $startTimePrevious
     * @param  carbon object $startTimeCurrent
     * @return int diff
     */
    public function getMarginTopForKursplan($startTimePrevious, $startTimeCurrent)
    {
        $gapPause = 240;
        $pauseStart = Carbon::createFromFormat('H:i:s', '13:00:00');
        $pauseEnd = Carbon::createFromFormat('H:i:s', '16:00:00');

        $diff = $startTimePrevious->diffInMinutes($startTimeCurrent)*1.5;

        if ($startTimeCurrent >= $pauseEnd && $startTimePrevious < $pauseStart) {
            $diff = $diff - $gapPause;
            return $diff;
        }

        return $diff;
    }
}
