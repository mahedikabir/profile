<?php

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
            'name' => 'Mahbubur Riad',
            'email' => 'mahbubur.riad@gmail.com',
            'password' => Hash::make('824726Riad'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Press Club',
            'email' => 'pressclub.sust@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '0171155555',
            'position' => 'Main Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
