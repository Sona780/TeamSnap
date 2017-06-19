<?php

namespace Org4Leagues;

use Illuminate\Database\Eloquent\Model;

class SitePref extends Model
{
    //
    protected $fillable = [ 'team_id', 'sort_player', 'color_scheme', 'game_notify', 'event_notify', 'availability', 'item_tracking_privacy', 'non_player_item_tracking', 'payment_tracking_privacy', 'non_player_payment_tracking', 'currency', 'time_format', 'date_format', 'assignment_tracking', 'score_tracking' ];

    public $timestamps = false;
}
