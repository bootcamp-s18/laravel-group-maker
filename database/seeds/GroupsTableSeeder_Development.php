<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GroupsTableSeeder_Development extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		// Activities
		$euchre = \App\Activity::where('name', '=', 'Euchre')->first();
		$baseball = \App\Activity::where('name', '=', 'Baseball')->first();
		$monopoly = \App\Activity::where('name', '=', 'Monopoly')->first();
		$dnd = \App\Activity::where('name', '=', 'Dungeons & Dragons')->first();

		// Creators
		$aaron = \App\User::where('name', '=', 'Aaron')->first();
		$erik = \App\User::where('name', '=', 'Erik')->first();
		$ian = \App\User::where('name', '=', 'Ian')->first();
		$opie = \App\User::where('name', '=', 'Opie')->first();
		$ursula = \App\User::where('name', '=', 'Ursula')->first();

		// Participants
		$beth = \App\User::where('name', '=', 'Beth')->first();
		$chris = \App\User::where('name', '=', 'Chris')->first();
		$dennis = \App\User::where('name', '=', 'Dennis')->first();



		// Group #1 - a full group with creator as participant
		// This example manipulates the database directly with insert statements.
    	DB::table('groups')->insert([
    		'name' => 'Aaron\'s Wednesday Card Game',
    		'description' => 'We meet at Taco Bell on Richmond Road',
    		'creator_id' => $aaron->id,
    		'activity_id' => $euchre->id,
    		'is_private' => 0,
    		'is_accepting_members' => 0,
    		'max_members' => 4,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

    	// Find the group we just created.
    	$group1 = \App\Group::where('name', '=', 'Aaron\'s Wednesday Card Game')->first();

    	// Add participants
    	DB::table('group_user')->insert([
    		'user_id' => $aaron->id,
    		'group_id' => $group1->id,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
       	]);
    	DB::table('group_user')->insert([
    		'user_id' => $beth->id,
    		'group_id' => $group1->id,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
       	]);
    	DB::table('group_user')->insert([
    		'user_id' => $chris->id,
    		'group_id' => $group1->id,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
       	]);
    	DB::table('group_user')->insert([
    		'user_id' => $dennis->id,
    		'group_id' => $group1->id,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
       	]);








    }
}
