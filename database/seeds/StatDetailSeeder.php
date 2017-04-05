<?php

use Illuminate\Database\Seeder;

class StatDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('stat_details')->delete();

    	$stats = [
            [ 'stat_name' => 'at_bats' ],
            [ 'stat_name' => 'runs' ],
            [ 'stat_name' => 'hits' ],
            [ 'stat_name' => 'doubles' ],
            [ 'stat_name' => 'triples' ],
            [ 'stat_name' => 'home_runs' ],
            [ 'stat_name' => 'runs_batted_in' ],
            [ 'stat_name' => 'bases_on_balls' ],
            [ 'stat_name' => 'strike_outs' ],
            [ 'stat_name' => 'stolen_bases' ],
            [ 'stat_name' => 'caught_stealing' ],
            [ 'stat_name' => 'average' ],
        ];

        StatDetail::insert($stats);
    }
}
