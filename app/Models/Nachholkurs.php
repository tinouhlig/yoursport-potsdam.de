<?php

namespace Yours\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Nachholkurs extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'nachholkurse';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['gueltig_bis', 'user_id', 'signedInCoursedate', 'signedOutCoursedate', 'status']; //status => "not used", "used"

    /**
     * Get the user which booked the coursedates.
     */
    public function user()
    {
        return $this->belongsTo('Yours\Models\User');
    }

    /**
     * Get the coursedate the user signed out.
     */
    public function signedOutCoursedate()
    {
        return $this->belongsTo('Yours\Models\Coursedate','signedOutCoursedate');
    }

    /**
     * Get the coursedate of the chosen Nachholkurs.
     */
    public function signedInCoursedate()
    {
        return $this->belongsTo('Yours\Models\Coursedate','signedInCoursedate');
    }

    /**
     * Creating the attribute for displaying the gueltig_bis
     */
    public function getGueltigBisFormatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->gueltig_bis)->format('d.m.Y');
    }

    public function scopeGueltig($query)
    {
        return $query->where('gueltig_bis','>=', Carbon::today()->format('Y-m-d'))->where('status', 'not used');
    }

    public function getIsUsedAttribute()
    {
        return $this->status == "used" ? true : false;
    }
}
