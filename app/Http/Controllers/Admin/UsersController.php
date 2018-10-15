<?php

namespace Yours\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;
use Yours\Events\UserWasRegisteredByAdmin;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Http\Requests\CreateUserRequest;
use Yours\Http\Requests\UpdateUserRequest;
use Yours\Jobs\SignInUserToCoursedateFromNachholkurs;
use Yours\Jobs\SignOutUserFromCoursedate;
use Yours\Models\BookedPrice;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Yours\Models\Nachholkurs;
use Yours\Models\Price;
use Yours\Models\User;
use Yours\Repositories\Eloquent\CourseRepository as CourseRepository;
use Yours\Repositories\Eloquent\CoursedateRepository as CoursedateRepository;
use Yours\Repositories\Eloquent\PriceRepository as PriceRepository;
use Yours\Repositories\Eloquent\UserRepository as UserRepository;

class UsersController extends Controller
{
    protected $userRepo, $priceRepo, $courseRepo, $coursedateRepo;

    function __construct(UserRepository $userRepo, PriceRepository $priceRepo, CourseRepository $courseRepo, CoursedateRepository $coursedateRepo)
    {
        $this->userRepo = $userRepo;
        $this->priceRepo = $priceRepo;
        $this->courseRepo = $courseRepo;
        $this->coursedateRepo = $coursedateRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showUsers()
    {
        $users = $this->userRepo->all();

        return view('admin.user.show_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createUser()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeUser(CreateUserRequest $request)
    {
        $password = str_random(8);
        $request['password'] = bcrypt($password);

        $user = $this->userRepo->create($request->all());

        event( new UserWasRegisteredByAdmin($user, $password) );

        flash()->success('Benutzer wurde erfolgreich angelegt.');

        return redirect()->route('admin::users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showUserData(User $user)
    {
        $user->load(['course', 'price', 'coursedate', 'nachholkurse', 'participantPrices', 'bookedPrices']);

        $pricelist = $user->price->lists('max_normalgroup_courses', 'id');

        $courses = $this->courseRepo->all()->lists('name_with_details', 'id');

        return view('admin.user.show_user_data', compact('user', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editUser(User $user)
    {
        return view('admin.user.edit_user_data', compact('user'));
    }

    /**
     * Show view to edit the user-price relationship
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function editUserPrices(User $user)
    {
        $user_prices = $user->price()->get();

        $user->load('bookedPrices.price', 'participantPrices.price');

        $prices_list = $this->priceRepo->lists('name', 'id');

        $prices = $this->priceRepo->all()->toArray();

        return view('admin.user.edit_user_price_data', compact('user', 'user_prices', 'prices', 'prices_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateUser(User $user, UpdateUserRequest $request)
    {
        $user->fill($request->all())->sluggify()->save();

        flash()->success('Benutzer wurde erfolgreich bearbeitet.');

        return redirect()->route('admin::users_show', $user->slug);
    }

    /**
     * updates a price relationship to the specific user
     * @param  User    $user    [description]
     * @param  Request $request [description]
     * @return Response           [description]
     */
    public function updateUserPrices(User $user, Request $request) //UpdateUserPriceRequest
    {
        $inputValues = array_only($request->all(), ['price_id', 'booked_at', 'expire_at']);

        $inputValues['cancelled'] = ($request->get('cancelled') ? 1 : 0);

        $prices = $user->price()->sync([$request->get('price_id') => $inputValues]);

        flash()->success('Preis wurde erfolgreich geändert.');

        return redirect()->route('admin::users_prices_edit', $user->slug);
    }

    public function addPartnerToUserPrices(User $user, Request $request)
    {
        $price = BookedPrice::find($request->get('price'));
        if ($user->all_prices->contains($price)) {
            flash()->warning('Dem Kunden ist dieser Preis bereits zugeordnet');
            return redirect()->back();
        }

        $price->participant()->attach($user->id);

        flash()->success('Der Kunde wurde erfolgreich zum Preis hinzugefügt');
        
        return redirect()->back();
    }

    public function detachPartnerFromUserPrices(User $user, $user_price_id)
    {
        if (! $user->participantPrices()->find($user_price_id)) {
            flash()->error('Preis ist nicht dem Kunden zugeordnet');
            return redirect()->back();
        }
        
        if (! $user->course()->byPriceID($user_price_id)->get()->isEmpty() ) {
            flash()->error('Der Kunde ist mit diesem Preis noch in einen Kurs eingetragen.');
            return redirect()->back();
        }

        $user->participantPrices()->detach($user_price_id);

        flash()->success('Der Kunde wurde erfolgreich aus dem Preis gelöscht');
        
        return redirect()->back();

    }

    /**
     * updates a course relationship to the specific user
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function createUserCourses(User $user, Request $request)
    {
        //validate Input
        $validator = Validator::make($request->all(), [
            'price_user_id' => 'required',
            'course_id' => 'required',
        ]);

        if ($validator->fails()) {
            flash()->error('Der Kurs konnte nicht hinzugefügt werden');
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }

        $user_price = BookedPrice::find($request->get('price_user_id'));

        // $booked_courses = $user->course()->where('price_user_id', $user_price->id)->get();
        $booked_courses = $user->course()->byPriceID($user_price->id)->get();
        $courses = Course::with('user')->findMany($request->get('course_id'));
        
        foreach ($booked_courses as $course) {
            if ($courses->contains($course)) {
                flash()->error('Der Kunde wurde bereits in einen der Kurse eingetragen');
                return redirect()->route('admin::users_show', $user->slug);
            }
        }
        
        if (($booked_courses->count() + $courses->count()) > $user_price->price->courses_per_week) {
            flash()->error('Der Preis ist überbucht.');
            return redirect()->route('admin::users_show', $user->slug);
        }

        $inputValues = array_map('intval', array_only($request->all(), ['price_user_id']));

        foreach ($request->get('course_id') as $id) {
            $course_ids_with_input[$id] = $inputValues;
        }

        $user->course()->attach($course_ids_with_input);

        foreach ($request->get('course_id') as $id) {
            $course = $user->course()->find($id);
            $coursedates = $course->coursedate()->active()->minDate($user_price->booked_at)->maxDate($user_price->expire_at)->lists('id');

            if ($user_price->price->duration_type == 'weeks') {
                $coursedates = $coursedates->take($user_price->price->course_count);
            }

            $user->coursedate()->attach($coursedates->toArray());
        }

        flash()->success('Kunde wurde erfolgreich in den Kurs eingetragen');

        return redirect()->route('admin::users_show', $user->slug);
    }

    /**
     * adds a price relationship to the specific user
     * @param  User    $user    [description]
     * @param  Request $request [description]
     * @return Response           [description]
     */
    public function createUserPrices(User $user, Request $request) //CreateUserPriceRequest
    {
        $inputValues = array_only($request->all(), ['booked_at', 'expire_at']);

        $prices = $user->price()->attach([$request->get('price') => $inputValues]);

        flash()->success('Preis wurde erfolgreich zugeordnet.');

        return redirect()->route('admin::users_prices_edit', $user->slug);
    }

    /**
     * deletes a price relationship from the specific user
     * @param  User    $user    [description]
     * @param  Request $request [description]
     * @return Response           [description]
     */
    public function detachUserPrices(User $user, $price_id, $user_price_id, Request $request)
    {
        $query = $user->price()->newPivotStatementForId($price_id)->where('id', $user_price_id)->delete();

        flash()->success('Preis wurde erfolgreich gelöscht.');

        return redirect()->route('admin::users_prices_edit', $user->slug);
    }

    /**
     * updates a course relationship to the specific user
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function detachUserCourses(User $user, $course_id)
    {
        $coursedates = $user->course()->find($course_id)->coursedate()->coming()->active()->lists('id')->toArray();

        $user->coursedate()->detach($coursedates);

        $user->course()->detach($course_id);

        flash()->success('Kunde wurde erfolgreich aus dem Kurs ausgetragen');

        return redirect()->route('admin::users_show', $user->slug);
    }
        /**
     * updates a course relationship to the specific user
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function detachUserCoursedate(User $user, $coursedate_id)
    {
        if (!$user->coursedate()->find($coursedate_id)) {#
            return back();
        }
        $coursedate = $user->coursedate()->find($coursedate_id);

        $this->dispatch( new SignOutUserFromCoursedate($user, $coursedate, true) );

        flash()->success('Kunde wurde erfolgreich aus dem Termin ausgetragen');

        return redirect()->back();
    }

    public function attachNachholkursToUser (User $user, $coursedate_id)
    {
        if ( $user->nachholkurse()->gueltig()->get()->count() == 0 ) {
            flash()->error('Der Kunde hat keine gültigen Nachholkurse.');
            return back();
        }
        if ($user->coursedate()->find($coursedate_id)) {
            flash()->error('Der Kunde ist bereits in diesen Kurs eingetragen.');
            return back();
        }

        if (! Coursedate::find($coursedate_id)->hasFreeSpots() ) {
            flash()->error('Der gewählte Kurs hat keine freien Plätze mehr.');
            return back();
        }

        $this->dispatch( new SignInUserToCoursedateFromNachholkurs($user, $coursedate_id) );

        return redirect()->route('admin::users_show', $user->slug);
    }

    public function detachNachholkursFromUser(User $user, $nachholkurs_id)
    {

        Nachholkurs::destroy($nachholkurs_id);

        flash()->success('Nachholkurs wurde gelöscht');

        return redirect()->back();
    }

    public function createNachholkursForUser(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), ['gueltig_bis' => 'required']);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        
        $user->nachholkurse()->save(new Nachholkurs(['gueltig_bis' => $request->get('gueltig_bis')]));

        flash()->success('Der Nachholkurs wurde erfolgreich angelegt');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(User $user)
    {
        $this->userRepo->delete($user->id);

        flash()->success('Benutzer wurde erfolgreich gelöscht.');

        return redirect()->back();
    }


}
