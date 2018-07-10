<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

    	DB::table('users')->insert([
    		'name' => 'Admin',
    		'email' => 'admin@example.com',
    		'password' => bcrypt('secret!'),
    		'is_admin' => 1,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

    }
}
