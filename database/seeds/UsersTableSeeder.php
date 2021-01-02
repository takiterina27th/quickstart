<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => 'testuser',
                'email' => 'testuser@example.com',
                'password' => Hash::make('testuser0123'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name' => 'testuser2',
                'email' => 'testuser2@example.com',
                'password' => Hash::make('testuser4567'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
