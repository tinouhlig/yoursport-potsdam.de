<?php

namespace Yours\Models;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Coursedate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coursedate';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'status', 'course_id'];

    protected $with = ['course', 'user'];

    protected $appends = ['mail_list'];

    /**
     * Get the course that owns the coursedate.
     */
    public function course()
    {
        return $this->belongsTo('Yours\Models\Course');
    }

    /**
     * Get the user which booked the coursedates.
     */
    public function user()
    {
        return $this->belongsToMany('Yours\Models\User')
                    ->withPivot('status')
                    ->withTimestamps();
    }

    public function getMonthAttribute()
    {
        return trans('months.'. Carbon::createFromFormat('Y-m-d', $this->date)->format('F'));
    }

    public function getUserCountAttribute()
    {
        return $this->user->count();
    }

    /**
     * Creating the attribute for displaying the startdate
     */
    public function getDateFormatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date)->format('d.m.Y');
    }

    public function getSignOutTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->date)->subDay()->setTime(18, 0, 0);
    }

    public function getFreiePlaetzeAttribute()
    {
        if (! $this->hasFreeSpots()) return "keine Plätze frei";

        if (Auth::check()) {
            $freiePlaetze = $this->course->max_participants - $this->user->count();
            return ($freiePlaetze > 1) ? ($freiePlaetze. " Plätze frei") : ($freiePlaetze. " Platz frei");
        }
        
        return "Plätze frei";
    }

    /**
     * Scope a query to only include active coursedates which will take place.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeComing($query)
    {
        return $query->where('date','>=', Carbon::now()->format('Y-m-d'));
    }

    public function scopeMinDate($query, $date)
    {
        return $query->where('date', '>=', $date);
    }

    /**
     * Scope a query to only include active coursedates.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include active coursedates.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaxDate($query, $date)
    {
        return $query->where('date','<=', $date);
    }

    /**
     * Scope a query to only include active coursedates.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWeek($query, $startOfWeek = null)
    {
        if (!$startOfWeek) {
            $start = Carbon::now()->startOfWeek();
            $end = Carbon::now()->endOfWeek();
        } else {
            $end = $startOfWeek->endOfWeek()->format('Y-m-d');
            $start = $startOfWeek->startOfWeek()->format('Y-m-d');
        }

        return $query->where('date','>=', $start)
                     ->where('date','<=', $end);
    }

    public function isComing()
    {
        return $this->getCarbonTimestamp() > Carbon::now();
    }

    public function getCarbonTimestamp()
    {
        $time = $this->course->getCarbonTime();
        $date = Carbon::createFromFormat('Y-m-d', $this->date);
        return $time->setDate($date->year, $date->month, $date->day);
    }

    public function hasFreeSpots()
    {
        return (( $this->course->max_participants - $this->user->count() ) > 0 );
    }

    public function getMailListAttribute()
    {
        return $this->user->map(function ($user) {
            return $user->email;
        })->implode(',');
    }


}
