<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
       $user->name = 'tushar';
       $user->email = 'tushar@gmail.com';
       $user->password = bcrypt('password');
       $user->phone_number = '01770353601';

       $user->save();
    }
}
