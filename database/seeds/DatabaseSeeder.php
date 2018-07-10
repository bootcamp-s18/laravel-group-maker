<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // These seeds should always run when setting up a new installtion.
        $this->call(UsersTableSeeder::class);

        // These seeds are just for testing and development.
        $this->call(UsersTableSeeder_Development::class);
        $this->call(ActivitiesTableSeeder_Development::class);
        $this->call(GroupsTableSeeder_Development::class);
    }
}
