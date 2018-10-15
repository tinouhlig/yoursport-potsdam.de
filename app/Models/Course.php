<?php

namespace Yours\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Course extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'course';

    protected $with = ['user'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'day', 'time', 'max_participants', 'length', 'start', 'end', 'slug', 'status', 'coursetype_id', 'user_id'];

    /**
     * The attributes for creating and saving the slug.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name_day',
        'save_to'    => 'slug',
    ];

    /**
     * Get the coursetype that owns the course.
     */
    public function coursetype()
    {
        return $this->belongsTo('Yours\Models\Coursetype');
    }

    /**
     * Get the coursetype that owns the course.
     */
    public function trainer()
    {
        return $this->belongsTo('Yours\Models\User', 'user_id');
    }

    /**
     * Get the user that booked the course.
     */
    public function user()
    {
        return $this->belongsToMany('Yours\Models\User', 'course_users', 'course_id', 'users_id')
                    ->withPivot('id', 'price_user_id')
                    ->withTimestamps();
    }

    /**
     * Get the coursedates that are owned by the course.
     */
    public function coursedate()
    {
        return $this->hasMany('Yours\Models\Coursedate');
    }

    public function getNameWithDetailsAttribute()
    {
        return $this->coursetype->name . ' '
                . $this->name . ' | '
                . $this->day . ' | '
                . $this->time . " Uhr";
    }

    /**
     * Creating the attribute for the slug by concate day and name
     */
    public function getNameDayAttribute()
    {
        return $this->coursetype->name . "-" . $this->day;
    }

    public function getNameWithDetailsPublicAttribute()
    {
        return $this->coursetype->name .
                ( !empty($this->name) ? (' ' . $this->name) : ('') ). ' um '
                . $this->time . ' Uhr ';
    }

    /**
     * Creating the attribute for displaying the name in the course plan
     */
    public function getNameKursplanAttribute()
    {
        return $this->coursetype->name . ' ' . $this->name;
    }

    /**
     * Creating the attribute for displaying the startdate
     */
    public function getStartDatumAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->start)->format('d.m.Y');
    }


    /**
     * Creating the attribute for displaying the enddate
     */
    public function getEndDatumAttribute()
    {
        if ($this->end == '0000-00-00') {
            return 'fortlaufend';
        }else{
            return Carbon::createFromFormat('Y-m-d', $this->end)->format('d.m.Y');
        }
    }

    /**
     * Creating the attribute for displaying the timespan the course takes place
     */
    public function getStartEndTimeAttribute()
    {
        $time = $this->getCarbonTime();

        return $time->format('H:i') . ' - ' . $time->addMinutes($this->length)->format('H:i');
    }

    public function getCarbonTime()
    {
        return Carbon::createFromTime(substr($this->time,0,2), substr($this->time,3,2), 0, null);
    }

    /**
     * Creating the attribute for displaying the enddate
     */
    public function getDayEnglishAttribute()
    {
        $days_array = [
            'Montag' => 'Monday',
            'Dienstag' => 'Tuesday',
            'Mittwoch' => 'Wednesday',
            'Donnerstag' => 'Thursday',
            'Freitag' => 'Friday',
            'Samstag' => 'Saturday',
            'Sonntag' => 'Sunday',
        ];

        return $days_array[$this->day];
    }

    /**
     * Creating a collection of coursedates in the future
     */
    public function getCoursedateFutureAttribute()
    {
        return $this->coursedate->filter( function($coursedate)
        {
            if ($coursedate->date >= Carbon::now()->format('Y-m-d')) {
                return true;
            }
        });
    }

    public function scopeByPriceID($query, $id)
    {
        $query->with(['user' => function($q) use ($id)
                {
                  $q->wherePivot('price_user_id','=', $id);
                }])
            ->whereHas('user',function($q) use ($id)
                {
                  $q->where('price_user_id', $id);
                });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function isActive($value='')
    {
        return $this->status == 'active';
    }
}
