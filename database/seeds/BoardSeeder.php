<?php

use Illuminate\Database\Seeder;
use App\Board;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $board = new Board();
        $board->category_id = 1;
        $board->slug = 'general-discussion';
        $board->title = 'General Discussion';
        $board->description = 'A place to generally discuss things.';
        $board->save();
    }
}
