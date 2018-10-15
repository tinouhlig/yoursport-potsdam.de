<?php

namespace Yours\Http\Controllers\Frontend;

use Auth;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Validator;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Jobs\SignInUserToCoursedateFromNachholkurs;
use Yours\Jobs\SignOutUserFromCoursedate;
use Yours\Models\Coursedate;
use Yours\Models\Nachholkurs;

class ProfileController extends Controller
{
    protected $user;

    function __construct(Request $request) {
        $this->user = $request->user()->load('course','coursedate', 'price', 'nachholkurse', 'trainedCourses');
    }

    public function index()
    {
        $user = $this->user;
        
        return view('public.pages.profile.dashboard', compact('user'));
    }

    public function showUserData()
    {
        $user = $this->user;

        return view('public.pages.profile.user_data', compact('user'));
    }

    public function saveNewPassword(Request $request)
    {
        $messages = [
            'old_password.required' => 'Das alte Passwort wird benötigt.',
            'password.required'  => 'Bitte geben Sie ein neues Passwort ein.',
            'password.min'  => 'Das neue Passwort muss mindestens 6 Zeichen lang sein.',
            'password.confirmed'  => 'Das neue Passwort stimmt nicht mit der Wiederholung überein.',
        ];

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ], $messages);

        if ($validator->fails()) {
            flash()->error('Passwort konnte nicht geändert werden');
            return redirect('/profile/dashboard#profil-stammdaten')
                        ->withErrors($validator);
        }

        $user = $this->user;

        if (Hash::check($request->input('old_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            flash()->success('Passwort wurde erfolgreich geändert');
            return redirect()->route('profile::dashboard');
        }

        flash()->error('Passwort konnte nicht geändert werden');
        return redirect('/profile/dashboard#profil-stammdaten')->withErrors('Das alte Passwort ist nicht korrekt.');

    }

    public function saveUserData(Request $request)
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
            return redirect()->route('profile::dashboard')
                        ->withErrors($validator);
        }

        $this->user->update($request->all());

        flash()->success('Ihre neuen Daten wurden gespeichert.');

        return redirect( route('profile::dashboard') . '#profil-stammdaten' );
    }

    public function showUserCoursedates()
    {
        $user = $this->user;

        return view('public.pages.profile.user_coursedates', compact('user'));
    }

    public function detachUserCoursedate($coursedate_id)
    {
        if (!$this->user->coursedate()->find($coursedate_id)) {
            return redirect('/');
        }
        
        $coursedate = $this->user->coursedate()->find($coursedate_id);

        $this->dispatch( new SignOutUserFromCoursedate($this->user, $coursedate) );

        flash()->success('Du wurdest erfolgreich aus dem Kurs ausgetragen');

        return redirect()->back();
    }

    public function attachNachholkursToUser($coursedate_id)
    {
        if ( !$this->user->nachholkurse()->gueltig()->get() ) {
            return back();
        }

        if (! Coursedate::find($coursedate_id)->hasFreeSpots() ) {
            flash()->error('Der gewählte Kurs hat keine freien Plätze mehr.');
            return back();
        }

        $this->dispatch( new SignInUserToCoursedateFromNachholkurs($this->user, $coursedate_id) );

        return redirect()->route('profile::dashboard');
    }
}
