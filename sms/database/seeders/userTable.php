<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class userTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            ['name'=>'Rafi','email'=>'rafi@gmail.com', 'password'=>'1223'],
            ['name'=>'Rana','email'=>'rana@gmail.com', 'password'=>'1223'],
            ['name'=>'imran','email'=>'imran@gmail.com', 'password'=>'1223'],
        ];
        User::insert($user);
    }
}
