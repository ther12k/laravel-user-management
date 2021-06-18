<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('create user table seeder...');
        
        DB::table('users')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
          'name' => 'Rizky',
          'email' => 'rizkyz@gmail.com',
          'role' => 'admin',
          'email_verified_at'=>date("Y-m-d H:i:s"),
          'password' => Hash::make('reapers123'),
        ]);
        DB::table('users')->insert([
          'name' => 'User Biasa',
          'email' => 'rizevarza@gmail.com',
          'role' => 'user',
          'email_verified_at'=>date("Y-m-d H:i:s"),
          'password' => Hash::make('password'),
        ]);
    }
}
