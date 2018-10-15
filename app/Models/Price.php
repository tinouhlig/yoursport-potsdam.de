<?php

namespace Yours\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Locale;

class Price extends Model implements SluggableInterface
{
    use SluggableTrait;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'amount', 'duration', 'duration_type','course_count', 'status', 'slug', 'first_cancel_period', 'further_cancel_period', 'contract_extension'];

    /**
     * The attributes for creating and saving the slug.
     *
     * @var array
     */
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    /**
     * Get the coursetype which are connected to the price.
     */
    public function coursetype()
    {
        return $this->belongsToMany('Yours\Models\Coursetype')->withTimestamps();;
    }

    /**
     * Get the course which are connected to the price.
     */
    public function course()
    {
        return $this->hasManyThrough('Yours\Models\Course', 'Yours\Models\Coursetype');
    }

    /**
     * Get the users which booked the price.
     */
    public function user()
    {
        return $this->belongsToMany('Yours\Models\User')
                    ->withPivot('id', 'booked_at', 'expire_at', 'cancelled')
                    ->withTimestamps();
    }

    /**
     * Creating the attribute for displaying the prices
     */
    public function getAmountGerAttribute() 
    {
        setlocale(LC_ALL, 'de_DE.utf8');

        return $this->amount;
    }

    /**
     * Creating the attribute for displaying the max_normalgroup_courses
     */
    public function getNormalCourseCountAttribute() 
    {
        if ($this->course_count < 0) {
            return 'unbegrenzt';
        } else {
            return $this->course_count;
        }
    }

    public function getCoursesPerWeekAttribute()
    {
        return $this->isContract() ? $this->course_count : 1;
    }

    public function isContract()
    {
        return $this->duration_type == "months";
    }

    public function scopeContract($query)
    {
        return $query->where('duration_type', 'months');
    }

    public function getDurationTypeGerAttribute()
    {
        return $this->isContract() ? "Monate" : "Wochen";
    }
}
