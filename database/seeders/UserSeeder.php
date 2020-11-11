<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'user_type' => '1',
            'name'    => 'user',
            'email'    => 'example@gmail.com',
            'password'   =>  Hash::make('password'),
            //'remember_token' =>  str_random(10),
        ]);

    }
}
