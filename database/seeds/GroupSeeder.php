<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group();
        $group->name = 'Regular Users';
        $group->description = 'The default user group.';
        $group->save();

        $group = new Group();
        $group->name = 'Admin';
        $group->description = 'The forum administrator group.';
        $group->save();

        $group = new Group();
        $group->name = 'Global Moderator';
        $group->description = 'Moderators who typically have full access to everything.';
        $group->save();
    }
}
