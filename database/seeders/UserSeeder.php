<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name'          => 'Admin',
            'email'         => 'admin@mail.com',
            'is_registered' => 1,
            'password'      => Hash::make('123123123'),
            'role'          => 'admin',
        ]);
    }
}
