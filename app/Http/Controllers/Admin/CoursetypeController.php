<?php

namespace Yours\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Yours\Http\Requests;
use Yours\Http\Requests\CreateCoursetypeRequest as CreateCoursetypeRequest;
use Yours\Http\Requests\UpdateCoursetypeRequest as UpdateCoursetypeRequest;
use Yours\Http\Controllers\Controller;
use Yours\Models\Course;
use Yours\Models\Coursetype;
use Yours\Repositories\Eloquent\CourseRepository as CourseRepository;
use Yours\Repositories\Eloquent\CoursetypeRepository as CoursetypeRepository;
use Yours\Repositories\Eloquent\PriceRepository as PriceRepository;

class CoursetypeController extends Controller
{
    protected $courseRepo, $coursetypeRepo, $priceRepo;

    function __construct(CourseRepository $courseRepo, CoursetypeRepository $coursetypeRepo, PriceRepository $priceRepo)
    {
        $this->courseRepo = $courseRepo;
        $this->coursetypeRepo = $coursetypeRepo;
        $this->priceRepo = $priceRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showCoursetypes()
    {
        $coursetypes = $this->coursetypeRepo->all();

        return view('admin.course.show_courses_and_coursetypes', compact('coursetypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $prices = $this->priceRepo->lists('name', 'id');
        return view('admin.course.create_coursetype', compact('prices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CreateCoursetypeRequest $request)
    {
        $coursetype = $this->coursetypeRepo->create($request->all());

        $coursetype->price()->attach($request->input('price_list'));

        flash()->success('Kursoberbegriff wurde erfolgreich angelegt.');

        return redirect()->route('admin::coursetypes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Coursetype $coursetype)
    {
        $prices = $coursetype->price()->get();
        $courses = $coursetype->course()->get();

        return view('admin.course.show_coursetype_data', compact('coursetype', 'prices', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Coursetype $coursetype)
    {
        $prices = $this->priceRepo->lists('name', 'id');

        return view('admin.course.edit_coursetype_data', compact('coursetype', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCoursetypeRequest $request, Coursetype $coursetype)
    {
        $coursetype->fill($request->all())->sluggify()->save();

        $coursetype->price()->sync($request->input('price_list'));

        flash()->success('Kursoberbegriff wurde erfolgreich bearbeitet.');

        return redirect()->route('admin::coursetypes_show', $coursetype->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Coursetype $coursetype)
    {
        $this->coursetypeRepo->delete($coursetype->id);

        flash()->success('Kursoberbegriff wurde erfolgreich gelöscht.');

        return redirect()->back();
    }
}
