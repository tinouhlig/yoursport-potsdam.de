<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
|
| Alle Routes die öffentlich erreichbar sind
|
*/
Route::get('/', ['as' => 'home', 'uses' => 'Frontend\PublicController@getHome']);
// Route::get('/', ['as' => 'home', function() {
//     return 'hey my friend';
// }]);

Route::match(['get', 'post'], '/kursplan/{year?}/{week?}', ['as' => 'kursplan', 'uses' => 'Frontend\PublicController@getKursplan']);

// Route::get('/kurse',['as' => 'kurse', 'uses' => 'Frontend\PublicController@getKurse']);
Route::get('/kurse/{coursetype}', ['as' => 'kurs', 'uses' => 'Frontend\PublicController@getKurs']);
Route::get('/impressum', ['as' => 'impressum', function() {
    return view('public.pages.impressum');
}]);
Route::get('/datenschutz', ['as' => 'datenschutz', function() {
    return view('public.pages.datenschutz');
}]);
Route::get('/preise', ['as' => 'preise', function() {
    return view('public.pages.preise');
}]);
Route::get('/about', ['as' => 'about', function() {
    return view('public.pages.about');
}]);
Route::get('/massagen', ['as' => 'massagen', function() {
    return view('public.pages.massagen');
}]);
Route::post('/massagen/anfrage', ['as' => 'massageanfrage','uses' => 'Frontend\PublicController@postMassageanfrage']);



Route::post('/kontakt', ['as' => 'kontakt', 'uses' => 'Frontend\PublicController@postKontakt']);
Route::post('/kontakt/kursanmeldung/', ['as' => 'kursanmeldung', 'uses' => 'Frontend\PublicController@postKursanmeldung']);
Route::post('/kontakt/home/kursanmeldung/', ['as' => 'homekursanmeldung', 'uses' => 'Frontend\PublicController@postHomeKursanmeldung']);


//API Routes

Route::group(['as' => 'api::', 'prefix' => 'api'], function () {

    Route::get('kurse', ['as' => 'kurse', function(Request $request) {
        return Yours\Models\Coursetype::active()->get();
    }]);

    Route::get('kurse/{coursetype}/tage', ['as' => 'kurstage', function(Request $request, $coursetype)  {
        return $coursetype->course->groupBy('day');
    }]);

    Route::get('clients', function () {
        return Yours\Models\User::clients()->get();
    });

    Route::get('clients/{user}', function (Yours\Models\User $user) {
        return $user->load('bookedPrices.price');
    });

});



//ENDE Public Area

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
|
| Alle Routes die zur ProfileSeite führen
| @NamePrefix: 'profile::'
| @RoutePrefix: 'profile'
| @middleware: 'auth'
|
*/
Route::group(['as' => 'profile::', 'prefix' => 'profile', 'middleware' => 'auth'], function () {

    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Frontend\ProfileController@index']);
    Route::get('/trainingstermine', ['as' => 'user_coursedates', 'uses' => 'Frontend\ProfileController@showUserCoursedates']);
    Route::get('/benutzerdaten', ['as' => 'user_show', 'uses' => 'Frontend\ProfileController@showUserData']);
    Route::post('/benutzerdaten/passwort', ['as' => 'save_password', 'uses' => 'Frontend\ProfileController@saveNewPassword']);
    Route::post('/benutzerdaten/stammdaten', ['as' => 'save_user_data', 'uses' => 'Frontend\ProfileController@saveUserData']);
    Route::get('/{coursedate_id}/detach', ['as' => 'coursedate_detach', 'uses' => 'Frontend\ProfileController@detachUserCoursedate']);
    Route::get('/{coursedate_id}/attach', ['as' => 'coursedate_attach', 'uses' => 'Frontend\ProfileController@attachNachholkursToUser']);
    Route::get('/test', ['as' => 'test', 'uses' => 'Frontend\ProfileController@test']);


});

/*
|--------------------------------------------------------------------------
| Trainer Routes
|--------------------------------------------------------------------------
|
| Alle Routes die zur ProfileSeite führen
| @NamePrefix: 'trainer::'
| @RoutePrefix: 'trainer'
| @middleware: 'trainer'
|
*/
Route::group(['as' => 'trainer::', 'prefix' => 'trainer', 'middleware' => 'trainer'], function () {

    Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'Trainer\TrainerController@index']);
    Route::post('/benutzerdaten/passwort', ['as' => 'save_password', 'uses' => 'Trainer\TrainerController@saveNewPassword']);
    Route::post('/benutzerdaten/stammdaten', ['as' => 'update', 'uses' => 'Trainer\TrainerController@update']);
    Route::get('{coursedate}', ['as' => 'show_coursedate', 'uses' => 'Trainer\TrainerController@showCoursedate']);


});

//ENDE Trainer Area

// Authentication routes...
Route::get('auth/login', ['as' => 'get_login', function() {
    return view('public.pages.login');
}]);
Route::post('auth/login', ['as' => 'post_login', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes...
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'post_register', 'uses' => 'Auth\AuthController@postRegister']);

// Password reset link request routes...
Route::post('password/email', ['as' => 'post_reset_email' ,'uses' => 'Auth\PasswordController@postEmail']);

// Password reset routes...
Route::get('password/reset/{token}', ['as' => 'get_reset_token', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('password/reset', ['as' => 'post_reset_token', 'uses' => 'Auth\PasswordController@postReset']);

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Alle Routes die zur Adminseite führen
| @NamePrefix: 'admin::'
| @RoutePrefix: 'admin'
| @Namespace: Admin
| @middleware: 'admin'
|
*/
Route::group(['as' => 'admin::', 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () { 
    // Route named "admin::dashboard"
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'AdminController@showDashboard']);

    // Userpanel
    Route::get('users', ['as' => 'users', 'uses' => 'UsersController@showUsers']);
    Route::get('users/create', ['as' => 'users_create', 'uses' => 'UsersController@createUser']);
    Route::post('users/create', ['as' => 'users_store', 'uses' => 'UsersController@storeUser']);
    Route::get('users/{user}/edit', ['as' => 'users_edit', 'uses' => 'UsersController@editUser']);
    Route::get('users/{user}/prices/edit', ['as' => 'users_prices_edit', 'uses' => 'UsersController@editUserPrices']);
    Route::post('users/{user}/courses/create', ['as' => 'users_courses_create', 'uses' => 'UsersController@createUserCourses']);
    Route::get('users/{user}/courses/{course_id}/detach', ['as' => 'users_courses_detach', 'uses' => 'UsersController@detachUserCourses']);
    Route::get('users/{user}/coursedate/{coursedate_id}/detach', ['as' => 'users_coursedate_detach', 'uses' => 'UsersController@detachUserCoursedate']);
    Route::get('users/{user}/coursedate/{coursedate_id}/attach', ['as' => 'users_coursedate_attach', 'uses' => 'UsersController@attachNachholkursToUser']);
    Route::post('users/{user}/prices/update', ['as' => 'users_prices_update', 'uses' => 'UsersController@updateUserPrices']);
    Route::post('users/{user}/prices/update-add-partner', ['as' => 'users_prices_update_add_partner', 'uses' => 'UsersController@addPartnerToUserPrices']);
    Route::get('users/{user}/prices/{user_price_id}/update-detach-partner', ['as' => 'users_prices_update_detach_partner', 'uses' => 'UsersController@detachPartnerFromUserPrices']);
    Route::post('users/{user}/prices/create', ['as' => 'users_prices_create', 'uses' => 'UsersController@createUserPrices']);
    Route::get('users/{user}/prices/{price_id}/{user_price_id}/detach', ['as' => 'users_prices_detach', 'uses' => 'UsersController@detachUserPrices']);
    Route::get('users/{user}/delete', ['as' => 'users_delete', 'uses' => 'UsersController@destroy']);
    Route::get('users/{user}', ['as' => 'users_show', 'uses' => 'UsersController@showUserData']);
    Route::post('users/{user}', ['as' => 'users_update', 'uses' => 'UsersController@updateUser']);
    Route::get('users/{user}/nachholkurs/{nachholkurs_id}/detach', ['as' => 'users_nachholkurs_detach', 'uses' => 'UsersController@detachNachholkursFromUser']);
    Route::post('users/{user}/nachholkurs/create', ['as' => 'users_nachholkurs_create', 'uses' => 'UsersController@createNachholkursForUser']);

    // Coursepanel
    Route::get('courses', ['as' => 'courses', 'uses' => 'CoursesController@showCourses']);
    Route::get('courses/create', ['as' => 'courses_create', 'uses' => 'CoursesController@create']);
    Route::post('courses/create', ['as' => 'courses_store', 'uses' => 'CoursesController@store']);
    Route::get('courses/{course}', ['as' => 'courses_show', 'uses' => 'CoursesController@show']);
    Route::get('courses/{course}/edit', ['as' => 'courses_edit', 'uses' => 'CoursesController@edit']);
    Route::get('courses/{course}/delete', ['as' => 'courses_delete', 'uses' => 'CoursesController@destroy']);
    Route::post('courses/{course}', ['as' => 'courses_update', 'uses' => 'CoursesController@update']);
    Route::post('courses/{course}/deactivate', ['as' => 'courses_deactivate', 'uses' => 'CoursesController@deactivate']);
    Route::post('courses/{course}/activate', ['as' => 'courses_activate', 'uses' => 'CoursesController@activate']);
    
    // Coursedatepanel
    Route::get('coursedates', ['as' => 'coursedates', 'uses' => 'CoursedateController@showCoursedates']);
    Route::get('coursedates/{user}', ['as' => 'coursedates_user', 'uses' => 'CoursedateController@showCoursedatesForUser']);
    Route::get('coursedate/{coursedate}', ['as' => 'coursedates_show', 'uses' => 'CoursedateController@show']);
    Route::post('coursedate/{coursedate}', ['as' => 'coursedates_create_Neukunde', 'uses' => 'CoursedateController@createNeukundeForCoursedate']);
    Route::get('coursedate/{coursedate}/deactivate', ['as' => 'coursedate_deactivate', 'uses' => 'CoursedateController@deactivate']);

    // Coursetypepanel
    Route::get('coursetypes', ['as' => 'coursetypes', 'uses' => 'CoursetypeController@showCoursetypes']);
    Route::get('coursetypes/create', ['as' => 'coursetypes_create', 'uses' => 'CoursetypeController@create']);
    Route::post('coursetypes/create', ['as' => 'coursetypes_store', 'uses' => 'CoursetypeController@store']);
    Route::get('coursetypes/{coursetype}', ['as' => 'coursetypes_show', 'uses' => 'CoursetypeController@show']);
    Route::get('coursetypes/{coursetype}/edit', ['as' => 'coursetypes_edit', 'uses' => 'CoursetypeController@edit']);
    Route::get('coursetypes/{coursetype}/delete', ['as' => 'coursetypes_delete', 'uses' => 'CoursetypeController@destroy']);
    Route::post('coursetypes/{coursetype}', ['as' => 'coursetypes_update', 'uses' => 'CoursetypeController@update']);

    // Financepanel
    Route::get('finance/dashboard', ['as' => 'prices_dashboard', 'uses' => 'PriceController@showDashboard']);
    Route::get('finance/booked/expiring', ['as' => 'prices_expiring', 'uses' => 'PriceController@showExpiringContracts']);
    Route::get('finance/booked/{booked_price}/extend', ['as' => 'prices_expiring_extend', 'uses' => 'PriceController@extendExpiringContracts']);
    Route::get('finance/booked/active', ['as' => 'prices_active', 'uses' => 'PriceController@showActiveContracts']);
    Route::get('finance', ['as' => 'prices', 'uses' => 'PriceController@showPrices']);
    Route::get('finance/create', ['as' => 'prices_create', 'uses' => 'PriceController@create']);
    Route::post('finance/create', ['as' => 'prices_store', 'uses' => 'PriceController@store']);
    Route::get('finance/{price}', ['as' => 'prices_show', 'uses' => 'PriceController@show']);
    Route::get('finance/{price}/edit', ['as' => 'prices_edit', 'uses' => 'PriceController@edit']);
    Route::get('finance/{price}/delete', ['as' => 'prices_delete', 'uses' => 'PriceController@destroy']);
    Route::post('finance/{price}', ['as' => 'prices_update', 'uses' => 'PriceController@update']);

});
//ENDE Admin Area

//redirect wenn seite nicht existiert
Route::get('/{name?}', function ($name = '') {
    return redirect()->route('home');
});
