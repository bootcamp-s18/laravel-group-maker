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
        $music = \App\Activity::where('name', '=', 'Music')->first();
        $comedy = \App\Activity::where('name','Stand-up Comedy')->first();
		$underWaterBasketWeaving = \App\Activity::where('name', '=', 'Under Water Basket Weaving')->first();
		$netflix = \App\Activity::where('name', '=', 'Netflix and Hot Takes')->first();


		// Creators
		$aaron = \App\User::where('name', '=', 'Aaron')->first();
		$erik = \App\User::where('name', '=', 'Erik')->first();
		$ian = \App\User::where('name', '=', 'Ian')->first();
		$opie = \App\User::where('name', '=', 'Opie')->first();
		$ursula = \App\User::where('name', '=', 'Ursula')->first();

        $kevin = \App\User::where('name', '=', 'Kevin')->first();
        $chrisBrowder = \App\User::where('name', '=', 'Chris Browder')->first();
        $kar = \App\User::where('name', '=', 'Kar')->first();
        $bethS = \App\User::where('name', '=', 'Beth Salvatore')->first();
        $dimitri = \App\User::where('name', '=', 'Dimitri')->first();
		$erik2 = \App\User::where('name', '=', 'Erik Wolfe')->first();
		$ryan = \App\User::where('name', '=', 'Ryan Borja')->first();

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
    		'is_accepting_members' => 1,
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
    		'is_accepting_members' => 1,
    		'max_members' => 4,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
			'default_lat' => 38.039189,
			'default_lon' => -84.5458872
		]);
		
		DB::table('groups')->insert([
    		'name' => 'Erik\'s Under Water Basket Weaving Group',
    		'description' => 'Once a year we all go to Ocracoke Island off the shore from North Carolina and wade amongst the fishies whilst we make our spirit baskets. These baskets represent our heart and soul and once we are finished we cast them out in the ocean with our worries and troubles.',
    		'creator_id' => $erik2->id,
    		'activity_id' => $underWaterBasketWeaving->id,
    		'is_private' => 0,
    		'is_accepting_members' => 1,
    		'max_members' => 80,
    		'is_virtual' => 1,
    		'invitation_key' => Uuid::generate(),
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
			'default_lat' => 35.1146,
			'default_lon' => 75.9810
    	]);

      	DB::table('groups')->insert([
    		'name' => 'Kar\'s Film Junkies',
    		'description' => 'We watch QUALITY movies while turning our noses up at mainstream cinema',
    		'creator_id' => $kar->id,
    		'activity_id' => $film->id,
    		'is_private' => 0,
    		'is_accepting_members' => 1,
    		'max_members' => 9,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
			'default_lat' => 37.80923,
			'default_lon' => -85.4669,
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now(),
    	]);

      // Beth's group
      DB::table('groups')->insert([
    		'name' => 'Beth\'s Bagpipes and Drums',
    		'description' => 'Grab your pipes, drums and kilts, and come play with us!',
    		'creator_id' => $bethS->id,
    		'activity_id' => $music->id,
    		'is_private' => 0,
    		'is_accepting_members' => 1,
    		'max_members' => 15,
    		'is_virtual' => 0,
    		'invitation_key' => Uuid::generate(),
            'default_lat' => 38.477102,
            'default_lon' => -86.540382,
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

        // Dimitri's Group
        $groupDimitri = new \App\Group;
        $groupDimitri->name = 'Stand-Up by Dimitri';
        $groupDimitri->description = 'I perform 3 minute routines with 1 minute intermissions. One-on-one sessions available. Laughing is mandatory.';
        $groupDimitri->creator_id = $dimitri->id;
        $groupDimitri->activity_id = $comedy->id;
        $groupDimitri->is_private = 0;
        $groupDimitri->is_accepting_members = 1;
        $groupDimitri->max_members = 2;
        $groupDimitri->is_virtual = 0;
        $groupDimitri->invitation_key = Uuid::generate();
        $groupDimitri->save();

		// Ryan's Group
        $groupRyan = new \App\Group;
        $groupRyan->name = 'Ryan\'s Opossum pals';
        $groupRyan->description = 'Meet every week to watch documentaries on animals, politics, history, etc... Then we form hot takes and kill each other on hills. Opossums are the best. Maybe board games. Definitely whiskey.';
        $groupRyan->creator_id = $ryan->id;
        $groupRyan->activity_id = $netflix->id;
        $groupRyan->is_private = 0;
        $groupRyan->is_accepting_members = 1;
        $groupRyan->max_members = 10;
        $groupRyan->is_virtual = 0;
        $groupRyan->invitation_key = Uuid::generate();
		$groupRyan->created_at = Carbon::now();
		$groupRyan->updated_at = Carbon::now();
		$groupRyan->default_lat = 41.8343182;
		$groupRyan->default_lon = -1.5331031;
		$groupRyan->save();
		
    }
}
