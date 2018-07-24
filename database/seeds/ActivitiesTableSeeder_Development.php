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

    }
}
