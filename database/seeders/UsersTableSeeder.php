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
        
        //DB::table('users')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
          'name' => 'Rizky',
          'email' => 'admin@nppbkc.com',
          'role' => 'admin',
          'email_verified_at'=>date("Y-m-d H:i:s"),
          'password' => Hash::make('admin12345'),
        ]);
        DB::table('users')->insert([
          'name' => 'Officer',
          'email' => 'rizkyz@gmail.com',
          'role' => 'officer',
          'email_verified_at'=>date("Y-m-d H:i:s"),
          'password' => Hash::make('rizkyz12345'),
        ]);
        DB::table('users')->insert([
          'name' => 'User Biasa',
          'email' => 'rizevarza@gmail.com',
          'role' => 'user',
          'email_verified_at'=>date("Y-m-d H:i:s"),
          'password' => Hash::make('rizevarza12345'),
        ]);
    }
}
