<?php

use Illuminate\Database\Seeder;

use TeamSnap\AllGame;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $games = [
            [ 'game_name' => 'Baseball' ],
        ];

        AllGame::insert($games);
    }
}
