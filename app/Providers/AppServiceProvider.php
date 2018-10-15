<?php

namespace Yours\Providers;

use DB;
use Event;
use Illuminate\Support\ServiceProvider;
use Yours\Models\Course;
use Yours\Models\Coursetype;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_TIME, 'German'); //local server
        // setlocale(LC_TIME, 'de_DE'); //production server
        
        if (env('APP_ENV') === 'local') {
            DB::connection()->enableQueryLog();
        }
        if (env('APP_ENV') === 'local') {
            Event::listen('kernel.handled', function ($request, $response) {
                if ( $request->has('sql-debug') ) {
                    $queries = DB::getQueryLog();
                    dd($queries);
                }
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
