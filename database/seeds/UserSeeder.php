<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->admin = true;
        $user->name = 'Admin';
        $user->email = 'admin@skitchbb.net';
        $user->password = Hash::make('admin');
        $user->save();
    }
}
