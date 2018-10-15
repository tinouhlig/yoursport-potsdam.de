<?php

namespace Yours\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Coursetype extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coursetype';

    /**
     * The modeldatas that are related to the model.
     *
     * @var array
     */
    protected $with = ['price', 'course'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'status', 'slug'];

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
     * Get the courses that are owned by the coursetype.
     */
    public function course()
    {
        return $this->hasMany('Yours\Models\Course');
    }

    /**
     * Get the prices which are connected zur the coursetype.
     */
    public function price()
    {
        return $this->belongsToMany('Yours\Models\Price')->withTimestamps();;
    }

    /**
     * Creating the attribute for displaying the prices
     */
    public function getPriceListAttribute() 
    {
        return $this->price->lists('id')->toArray();
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
}
