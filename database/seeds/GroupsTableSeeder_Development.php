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
    $knitting = \App\Activity::where('name', '=', 'Knitting')->first();
    $soccer = \App\Activity::where('name', '=', 'Soccer')->first();
    $film = \App\Activity::where('name', '=', 'Film')->first();

		// Creators
		$aaron = \App\User::where('name', '=', 'Aaron')->first();
		$erik = \App\User::where('name', '=', 'Erik')->first();
		$ian = \App\User::where('name', '=', 'Ian')->first();
		$opie = \App\User::where('name', '=', 'Opie')->first();
		$ursula = \App\User::where('name', '=', 'Ursula')->first();
    $kevin = \App\User::where('name', '=', 'Kevin')->first();
    $chrisBrowder = \App\User::where('name', '=', 'Chris Browder')->first();
    $kar = \App\User::where('name', '=', 'Kar')->first();

		// Participants
		$beth = \App\User::where('name', '=', 'Beth')->first();
		$chris = \App\User::where('name', '=', 'Chris')->first();
		$dennis = \App\User::where('name', '=', 'Dennis')->first();



		// Group #1 - a full group with creator as participant.
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

      DB::table('groups')->insert([
    		'name' => 'Kevin\'s Knitting Circle',
    		'description' => 'We knit socks for possums',
    		'creator_id' => $kevin->id,
    		'activity_id' => $knitting->id,
    		'is_private' => 0,
    		'is_accepting_members' => 0,
    		'max_members' => 4,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
        'default_lat' => 38.039189,
        'default_lon' => -84.5458872
    	]);

      DB::table('groups')->insert([
    		'name' => 'Kar\'s Film Junkies',
    		'description' => 'We watch QUALITY movies while turning our noses up at mainstream cinema',
    		'creator_id' => $kar->id,
    		'activity_id' => $film->id,
    		'is_private' => 0,
    		'is_accepting_members' => 0,
    		'max_members' => 9,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
        'default_lat' => 37.80923,
        'default_lon' => -85.4669
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
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



    	// Group #2 - a private group that's looking for a player, with creator as participant.
    	// This example uses models to interact with the database.
    	$group2 = new \App\Group;
    	$group2->name = 'Erik Loves Monopoly';
    	$group2->description = 'Erik says he hates Monopoly, but we make him play anyway';
    	$group2->creator_id = $erik->id;
    	$group2->activity_id = $monopoly->id;
    	$group2->is_private = 1;
    	$group2->is_accepting_members = 1;
    	$group2->max_members = 4;
    	$group2->is_virtual = 0;
    	$group2->invitation_key = Uuid::generate();
    	$group2->save();

    	// Add members to group
    	$group2->members()->attach($erik->id);
    	$group2->members()->attach($chris->id);
    	$group2->members()->attach(\App\User::where('name', '=', 'Ginny')->first()->id);




        // Chris B's group
        $groupChris = new \App\Group;
    	$groupChris->name = 'Woodland Soccer Club';
    	$groupChris->description = 'Soccer at Woodland Park';
    	$groupChris->creator_id = $chrisBrowder->id;
    	$groupChris->activity_id = $soccer->id;
    	$groupChris->is_private = 0;
    	$groupChris->is_accepting_members = 1;
    	$groupChris->max_members = 22;
    	$groupChris->is_virtual = 0;
    	$groupChris->invitation_key = Uuid::generate();
    	$groupChris->save();

    	// Add members to Chris B's group
    	$groupChris->members()->attach($erik->id);
    	$groupChris->members()->attach($chris->id);
        $groupChris->members()->attach($beth->id);
        $groupChris->members()->attach($dennis->id);
        $groupChris->members()->attach($ursula->id);
        $groupChris->members()->attach($ian->id);
        $groupChris->members()->attach($aaron->id);
        $groupChris->members()->attach($chrisBrowder->id);
        $groupChris->members()->attach($opie->id);
    	$groupChris->members()->attach(\App\User::where('name', '=', 'Ginny')->first()->id);

    }
}
