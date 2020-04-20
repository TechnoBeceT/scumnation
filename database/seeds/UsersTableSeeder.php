<?php

use App\Models\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'steamid'   => '76561198009780481',
            'nickname'  => 'TechnoBeceT'
        ]);
    }
}
