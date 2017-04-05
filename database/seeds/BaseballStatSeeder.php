<?php

use Illuminate\Database\Seeder;

class BaseballStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('game_stats')->delete();

        $first = StatDetail::where('stat_name', 'at_bats')->first()->id;

        for($i = 0; $i < 11; $i++)
        	GameStat:insert(['game_type_id' => 1, 'stat_details_id' => $first+$i]);
    }
}
