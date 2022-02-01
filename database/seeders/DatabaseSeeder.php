<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'refaqatkhattak88@gmail.com',
            'status' => 'Active',
            'password' => Hash::make('12345678'),

        ]);
    }
}
