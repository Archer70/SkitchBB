<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    const ADMIN_GROUP = 2;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->group_id = self::ADMIN_GROUP;
        $user->name = 'Admin';
        $user->email = 'admin@skitchbb.net';
        $user->password = Hash::make('admin');
        $user->title = 'Registered Member';
        $user->avatar_url = 'https://www.synbio.cam.ac.uk/images/avatar-generic.jpg/image';
        $user->save();
    }
}
