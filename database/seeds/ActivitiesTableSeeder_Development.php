<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ActivitiesTableSeeder_Development extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::table('activities')->insert([
    		'name' => 'Euchre',
    		'description' => 'A trick-taking card game played with standard playing cards',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

    	DB::table('activities')->insert([
    		'name' => 'Monopoly',
    		'description' => 'A board game about buying and trading property',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

    	DB::table('activities')->insert([
    		'name' => 'Baseball',
    		'description' => 'A bat-and-ball game played between two opposing teams',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

    	DB::table('activities')->insert([
    		'name' => 'Dungeons & Dragons',
    		'description' => 'A roleplaying game set in a fantasy world',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

      DB::table('activities')->insert([
    		'name' => 'Knitting',
    		'description' => 'A crafting hobby involving weaving thread to create garments',
        'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
    	]);

      DB::table('activities')->insert([
    		'name' => 'Soccer',
    		'description' => 'Come play pick-up soccer!',
    		'created_at' => Carbon::now(),
    		'updated_at' => Carbon::now()
  	   ]);

      DB::table('activities')->insert([
        'name' => 'Film',
        'description' => 'We watch movies',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
	  ]);
	  
	  	DB::table('activities')->insert([
        'name' => 'Under Water Basket Weaving',
        'description' => 'The art or activity of creating woven baskets under water.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      DB::table('activities')->insert([
        'name' => 'Stand-up Comedy',
        'description' => 'Practice jokes or have a laugh!',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);
      
      DB::table('activities')->insert([
        'name' => 'Music',
        'description' => 'An informal group of musicians that gather to play music.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

			DB::table('activities')->insert([
        'name' => 'Netflix and Hot Takes',
        'description' => 'Liberté, égalité, fraternité my dude. Opossums are the best. This is the hill I will die on.',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

    }
}
