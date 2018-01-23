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
        $current_time = Carbon::now()->toDateTimeString();

        DB::table('users')->insert([
            'username' => 'admin123',
            'password' => bcrypt('admin123'),
            'user_type' => 0,
            'user_status' => 1,
            'created_at' => $current_time,
            'updated_at' => $current_time,
        ]);

        DB::table('profiles')->insert([
            'profile_user_id' => 1,
            'fname' => 'Admin',
            'mname' => 'A',
            'lname' => 'Admin', 
            'gender' => 1,
            'bday' => '2018-01-14',
            'cnum' => '12345678900',
            'created_at' => $current_time,
            'updated_at' => $current_time,
        ]);
    }
}
