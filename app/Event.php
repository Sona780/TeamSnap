<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Event extends Model
{
    //
    protected $fillable = [
         'team_id', 'name', 'label', 'date', 'hour', 'minute', 'time','repeat', 'location_detail_id',
    ];

    public function scopeEvents($query, $id)
    {
        $query->where('team_id', $id)->where('date', '>=', Carbon::now()->format('d/m/Y'))->orderBy('updated_at', 'latest');
    }
}
