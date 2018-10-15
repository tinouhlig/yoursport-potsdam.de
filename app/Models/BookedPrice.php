<?php

namespace Yours\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BookedPrice extends Model
{
    // Model für gebuchte Preise
    // Relations: User, Price

    protected $table = 'price_user';

    protected $fillable = ['booked_at', 'expire_at', 'cancelled', 'extensions_count'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'booked_at',
        'expire_at'
    ];

    public function user()
    {
        return $this->belongsTo('Yours\Models\User');
    }

    public function participant()
    {
        return $this->belongsToMany('Yours\Models\User', 'bookedPrice_participant', 'bookedPrice_id', 'participant_id');
    }

    public function price()
    {
        return $this->belongsTo('Yours\Models\Price');
    }

    public function scopeContract($query)
    {
        return $query->whereHas('price', function ($query) {
            $query->where('duration_type', 'months');
        });
    }

    public function scopeActive($query)
    {
        return $query->where('cancelled', 0);
    }

    public function getExpireAtFormatedAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->expire_at)->format('d.m.Y');
    }
}
