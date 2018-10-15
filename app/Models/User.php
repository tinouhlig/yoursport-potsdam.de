<?php

namespace Yours\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, SluggableInterface
{
    use Authenticatable, CanResetPassword, SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'role', 'phone', 'slug'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['fullname'];

    /**
     * The attributes for creating and saving the slug.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'fullname',
        'save_to'    => 'slug',
    ];

    /**
     * Get the course that is booked by the user.
     */
    public function course()
    {
        return $this->belongsToMany('Yours\Models\Course', 'course_users', 'users_id', 'course_id')
                    ->withPivot('id', 'price_user_id')
                    ->withTimestamps();
    }

    /**
     * Get the courses that are trained by this user.
     */
    public function trainedCourses()
    {
        return $this->hasMany('Yours\Models\Course');
    }

    /**
     * Get the users which booked the price.
     */
    public function price()
    {
        return $this->belongsToMany('Yours\Models\Price')
                    ->withPivot('id', 'booked_at', 'expire_at', 'cancelled')
                    ->withTimestamps();
    }

    /**
     * Get the user which booked the coursedates.
     */
    public function coursedate()
    {
        return $this->belongsToMany('Yours\Models\Coursedate')
                    ->withPivot('status')
                    ->withTimestamps();
    }
    /**
     * Get the nachholkurse which booked the coursedates.
     */
    public function nachholkurse()
    {
        return $this->hasMany('Yours\Models\Nachholkurs');
    }

    public function bookedPrices()
    {
        return $this->hasMany('Yours\Models\BookedPrice');
    }

    public function participantPrices()
    {
        return $this->belongsToMany('Yours\Models\BookedPrice', 'bookedPrice_participant', 'participant_id', 'bookedPrice_id');
    }

    /**
     * Creating the attribute for the full name by concate first and last name
     */
    public function getFullnameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getMonthAttribute()
    {
        return trans('months_short.'. Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('M')) . ' ' . Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('y');
    }

    /**
     * Creating the attribute for the full name by concate first and last name
     */
    public function getIsAktiveAttribute()
    {
        if ($this->role == 'inaktiv') {
            return false;
        }
        return true;
    }

    /**
     * Creating the attribute for displaying the courses
     */
    public function getCourseListAttribute()
    {
        return $this->course->lists('id')->toArray();
    }

    /**
     * Creating the attribute for displaying the max_normalgroup_courses for the User
     */
    public function getNormalCourseCountAttribute()
    {
        if ($this->price->min('max_normalgroup_courses') < 0) {
            return 'unbegrenzt';
        } else {
            return $this->price->sum('max_normalgroup_courses');
        }
    }

    /**
     * Creating the attribute for displaying the max_smallgroup_courses for the user
     */
    public function getSmallCourseCountAttribute()
    {
        if ($this->price->min('max_smallgroup_courses') < 0) {
            return 'unbegrenzt';
        } else {
            return $this->price->sum('max_smallgroup_courses');
        }
    }

    /**
     * Creating the attribute for displaying the user_role for the user
     */
    public function getUserRoleAttribute()
    {
        switch ($this->role) {
            case 'client':
                return 'Kunde';
                break;
            case 'admin':
                return 'Administrator';
                break;
            case 'trainer':
                return 'Trainer';
                break;
            case 'Neukunde':
                return 'Neukunde';
                break;
            case 'inaktiv':
                return 'Inaktiv';
                break;
        }
    }

    public function isAdmin()
    {
        return $this->role == ('admin') ? true : false ;
    }

    public function isTrainer()
    {
        return $this->role == ('trainer') ? true : false ;
    }

    public function getComingCoursedatesAttribute()
    {
        return $this->coursedate()->coming()->get()->filter(function($coursedate){
            return $coursedate->status == 'active';
        })->sortBy('date')->take(3);
    }

    public function getAllPricesAttribute()
    {
        return $this->bookedPrices->merge($this->participantPrices);
    }

    /**
     * Scope a query to only include client users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClients($query)
    {
        return $query->where('role','=', 'client');
    }
}
