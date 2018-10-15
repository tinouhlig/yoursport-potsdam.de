<?php

namespace Yours\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Http\Requests\CreateNeukundeRequest;
use Yours\Jobs\SignOutUserFromCoursedate;
use Yours\Models\Coursedate;
use Yours\Models\User;

class CoursedateController extends Controller
{
    public function showCoursedates()
    {
        $coursedates = Coursedate::with('course', 'user')->active()->coming()->orderBy('date')->get();
        
        return view('admin.coursedates.show_coursedates', compact('coursedates'));
    }

    public function showCoursedatesForUser(User $user)
    {
        $coursedates = Coursedate::with('course', 'user')->coming()->active()->orderBy('date')->get();
        
        return view('admin.coursedates.show_coursedates', compact('coursedates', 'user'));
    }

    public function deactivate(Coursedate $coursedate)
    {
        $coursedate->user->each(function ($user) use ($coursedate) {
        	$this->dispatch( new SignOutUserFromCoursedate($user, $user->coursedate->find($coursedate->id), true) );
        });

        $coursedate->status = 'inactive';
        $coursedate->save();

        flash()->success('Der Kurse wurde erfolgreich deaktiviert.');
        return back();
    }

    public function show(Coursedate $coursedate)
    {
        $coursedate = $coursedate->load('course', 'user');

        $userMails = $coursedate->user->map(function ($user) {
            return $user->email;
        })->implode(',');

        return view('admin.coursedates.show', compact('coursedate', 'userMails'));
    }

    public function createNeukundeForCoursedate(CreateNeukundeRequest $request, Coursedate $coursedate)
    {
        $email = empty($request->get('email')) ? 
                ($request->get('first_name'). '-' .$request->get('last_name'). str_random(8) . '@yoursport-potsdam.de') : 
                $request->get('email');

        $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $email,
                'role' => 'Neukunde',
                'password' => bcrypt('yoursport')
            ]);

        $coursedate->user()->attach($user->id);

        flash()->success('Der Kunde wurde erfolgreich zum Kurstermin hinzugefügt');

        return redirect()->back();
    }
}
