<?php

namespace Yours\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Http\Requests\CreateCourseRequest as CreateCourseRequest;
use Yours\Http\Requests\UpdateCourseRequest as UpdateCourseRequest;
use Yours\Jobs\UpdateCoursedateTable;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Yours\Models\User;
use Yours\Repositories\Eloquent\CourseRepository as CourseRepository;
use Yours\Repositories\Eloquent\CoursetypeRepository as CoursetypeRepository;

class CoursesController extends Controller
{
    protected $courseRepo, $coursetypeRepo;

    function __construct(CourseRepository $courseRepo, CoursetypeRepository $coursetypeRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->coursetypeRepo = $coursetypeRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showCourses()
    {
        $courses = $this->courseRepo->all();

        return view('admin.course.show_courses_and_coursetypes', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $coursetypes = $this->coursetypeRepo->lists('name', 'id');

        $trainer = User::whereIn('role', ['trainer', 'admin'])->get();

        $trainer = $trainer->lists('fullname', 'id');

        return view('admin.course.create_course', compact('coursetypes', 'trainer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateCourseRequest $request)
    {
        $this->courseRepo->create($request->all());

        $this->dispatch(new UpdateCoursedateTable());

        flash()->success('Kurs wurde erfolgreich angelegt.');

        return redirect()->route('admin::courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  Course  $course
     * @return Response
     */
    public function show(Course $course)
    {
        $course->load([
            'coursedate'=>function ($query) {
                $query->orderBy('date', 'asc');
            },
            'coursetype',
            'trainer',
            'user'
        ]);

        $courses = Course::active()->get();
        
        $userMails = $course->user->map(function ($user) {
            return $user->email;
        })->implode(',');

        return view('admin.course.show_course_data', compact('course', 'courses', 'userMails'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Course $course)
    {
        $coursetypes = $this->coursetypeRepo->lists('name', 'id');

        $trainer = User::whereIn('role', ['trainer', 'admin'])->get();

        $trainer = $trainer->lists('fullname', 'id');
        
        return view('admin.course.edit_course_data', compact('course', 'coursetypes','trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->fill($request->all())->sluggify()->save();

        $this->dispatch(new UpdateCoursedateTable());

        flash()->success('Kurs wurde erfolgreich bearbeitet.');
        
        return redirect()->route('admin::courses_show', $course->slug);
    }

    public function deactivate(Request $request, Course $course)
    {
        if ($request->has('user_course')) {
            foreach ($request->user_course as $user_id => $course_id) {
                $user = $course->user->where('id', $user_id)->first();
                $user_price = $user->all_prices->where('id', $user->pivot->price_user_id)->first();

                $user->course()->attach($course_id, ['price_user_id' => $user_price->id]);
                
                $coursedates = Course::find($course_id)->coursedate()->active()->minDate($request->get('deactivate_on'))->maxDate($user_price->expire_at)->lists('id');
                // abzweigung für karten einbauen. Derzeit nur für Verträge.

                $user->coursedate()->attach($coursedates->toArray());
            }
        }
        $course->user()->detach();
        $coursedatesToDestroy = $course->coursedate()->minDate($request->get('deactivate_on'))->get()->lists('id')->toArray();
        Coursedate::destroy($coursedatesToDestroy);

        $course->status = 'inactive';
        $course->end = $request->get('deactivate_on');
        $course->save();

        flash()->success('Kurs wurde erfolgreich deaktiviert.');
        
        return redirect()->route('admin::courses_show', $course->slug);
    }

    public function activate(Request $request, Course $course)
    {
        $course->status = 'active';
        $course->start = $request->input('start');
        $course->end = $request->input('end');
        $course->save();

        // dd($course);

        $this->dispatch(new UpdateCoursedateTable());

        return redirect()->route('admin::courses_show', $course->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Course $course)
    {
        $this->courseRepo->delete($course->id);

        flash()->success('Kurs wurde erfolgreich gelöscht.');

        return redirect()->back();
    }
}
