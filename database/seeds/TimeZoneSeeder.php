<?php

use Illuminate\Database\Seeder;
use Org4Leagues\TimeZone;

class TimeZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $zones = [
            [ 'zone_name' => '(GMT-11:00) Midway Islands Time' ],
            [ 'zone_name' => '(GMT-10:00) Hawaii Standard Time' ],
            [ 'zone_name' => '(GMT-9:00) Alaska Standard Time' ],
            [ 'zone_name' => '(GMT-8:00) Pacific Standard Time' ],
            [ 'zone_name' => '(GMT-7:00) Phoenix Standard Time' ],
            [ 'zone_name' => '(GMT-7:00) Mountain Standard Time' ],
            [ 'zone_name' => '(GMT-6:00) Central Standard Time' ],
            [ 'zone_name' => '(GMT-5:00) Eastern Standard Time' ],
            [ 'zone_name' => '(GMT-5:00) Indiana Eastern Standard Time' ],
            [ 'zone_name' => '(GMT-4:00) Puerto Rico and US Virgin Islands Time' ],
            [ 'zone_name' => '(GMT-3:00) Canada Newfoundland Time' ],
            [ 'zone_name' => '(GMT-3:00) Argentina Standard Time' ],
            [ 'zone_name' => '(GMT-3:00) Brazil Eastern Time' ],
            [ 'zone_name' => '(GMT-1:00) Central African Time' ],
            [ 'zone_name' => '(GMT) Greenwich Mean Time' ],
            [ 'zone_name' => '(GMT+1:00) European Central Time' ],
            [ 'zone_name' => '(GMT+2:00) Eastern European Time' ],
            [ 'zone_name' => '(GMT+2:00) Arabic Standard Time' ],
            [ 'zone_name' => '(GMT+3:00) Eastern African Time' ],
            [ 'zone_name' => '(GMT+3:30) Middle East Time' ],
            [ 'zone_name' => '(GMT+4:00) Near East Time' ],
            [ 'zone_name' => '(GMT+5:00) Pakistan Lahore Time' ],
            [ 'zone_name' => '(GMT+5:30) India Standard Time' ],
            [ 'zone_name' => '(GMT+6:00) Bangladesh Standard Time' ],
            [ 'zone_name' => '(GMT+7:00) Vietnam Standard Time' ],
            [ 'zone_name' => '(GMT+8:00) China Taiwan Time' ],
            [ 'zone_name' => '(GMT+9:00) Japan Standard Time' ],
            [ 'zone_name' => '(GMT+9:30) Australia Central Time' ],
            [ 'zone_name' => '(GMT+10:00) Australia Eastern Time' ],
            [ 'zone_name' => '(GMT+11:00) Soloman Standard Time' ],
            [ 'zone_name' => '(GMT+12:00) New Zealand Standard Time' ],
        ];

        TimeZone::insert($zones);
    }
}
