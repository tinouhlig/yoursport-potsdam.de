<?php

namespace Yours\Http\Controllers\Trainer;

use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Validator;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Jobs\SignInUserToCoursedateFromNachholkurs;
use Yours\Jobs\SignOutUserFromCoursedate;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Yours\Models\Nachholkurs;

class TrainerController extends Controller
{

    protected $user;

    function __construct(Request $request) {
        $this->user = $request->user();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = $this->user->load(['trainedCourses.coursedate' => function ($query) {
                $query->with('course', 'user')->where('date','>=', Carbon::now()->format('Y-m-d'))->where('status', 'active');
            }]);

        $coursedates = $user->trainedCourses->pluck('coursedate')->collapse()->sortBy('date')->groupBy('date')->take(4);

        return view('trainer.dashboard', compact('user', 'coursedates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $messages = [
            'first_name.required' => 'Ihr Vorname wird benötigt.',
            'last_name.required'  => 'Ihr Nachname wird benötigt.',
            'email.required'  => 'Ihre E-Mailadresse wird benötigt.',
            'email.email'  => 'Die angegebene E-Mailadresse hat nicht das passende Format.',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ], $messages);

        if ($validator->fails()) {
            flash()->error('Ihre Daten konnten nicht geändert werden.');
            return redirect()->route('trainer::dashboard')
                        ->withErrors($validator);
        }

        $this->user->update($request->all());

        flash()->success('Ihre neuen Daten wurden gespeichert.');

        return redirect()->route('trainer::dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCoursedate(Coursedate $coursedate)
    {
        return view('trainer.showCoursedate', compact('coursedate', 'userMails'));
    }
}
