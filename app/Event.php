<?php

namespace TeamSnap;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Event extends Model
{
    //
    protected $fillable = [
         'users_id', 'teams_id', 'name', 'label', 'date', 'hour', 'minute', 'time','repeat','locations_id',
    ];

    public function scopeEvents($query, $id)
    {
        $query->where('teams_id', $id)->where('date', '>=', Carbon::now()->format('d/m/Y'));
    }
}
