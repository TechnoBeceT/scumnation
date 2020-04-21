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
        $this->call(UsersTableSeeder::class);
        $this->call(CategoryTypesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(SubscriberPlansTableSeeder::class);
        $this->call(SubscriberPlanContentsTableSeeder::class);
        $this->call(SalesTableSeeder::class);
    }
}
