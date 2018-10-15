<?php

namespace Yours\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Yours\Http\Controllers\Controller;
use Yours\Http\Requests;
use Yours\Models\BookedPrice;
use Yours\Models\Course;
use Yours\Models\Coursedate;
use Yours\Models\User;

class AdminController extends Controller
{
    public function showDashboard()
    {
    	$users = User::clients()->get();
    	$courses = Course::where('status', 'active')->get();
        $coursedates = Coursedate::with(['course', 'user'])
                                    ->coming()
                                    ->active()
                                    ->maxDate(Carbon::now()->addMonths(2)->format('Y-m-d'))
                                    ->get()
                                    ->sortBy('date')
                                    ->groupBy('date')
                                    ->take(4);

        $chart_users = $users->groupBy('month');

        $chart_users_array['labels'] = $chart_users->keys()->toArray();

        $chart_users_array['data'] = $chart_users->each(function ($month) {
            $month['data'] = $month->count();
        })->pluck('data')->toArray();

        $chart_coursedates = Coursedate::with('user')
                                ->minDate(Carbon::now()->subMonths(6)->startOfMonth()->format('Y-m-d'))
                                ->maxDate(Carbon::now()->startOfMonth()->subDay()->format('Y-m-d'))
                                ->get()
                                ->groupBy('month');

        $chart_coursedates_array = [];
        $chart_coursedates_array['labels'] = $chart_coursedates->keys()->toArray();

        $chart_coursedates_array['data'] = $chart_coursedates->each(function ($month) use ($chart_coursedates_array) {
            $month['data'] = $month->sum('user_count');
        })->pluck('data')->toArray();

        $monatliche_einnahmen = BookedPrice::with('price')->active()->contract()->get()->sum('price.amount');

        $coming_dates = $coursedates->keys()->map(function ($value, $key) {
            return Carbon::parse($value);
        });
        
        $expiring_contracts = BookedPrice::with('user', 'price')->contract()->active()->get()
                    ->filter(function ($contract) {
                        $kuendigungsfrist = $contract->extensions_count > 0 ? $contract->price->further_cancel_period : $contract->price->first_cancel_period;
                        return $contract->expire_at->subMonths($kuendigungsfrist)->lte(Carbon::now());
                    })->count();

        return view('admin.dashboard', compact('users', 'courses', 'coursedates', 'coming_dates', 'expiring_contracts', 'monatliche_einnahmen', 'chart_coursedates_array', 'chart_users_array'));
    }
}

