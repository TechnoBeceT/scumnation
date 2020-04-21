<?php

use Illuminate\Database\Seeder;

class PacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryTypes = [
			['type_name' => 'Weapons'],
			['type_name' => 'Gear'],
			['type_name' => 'Food'],
			['type_name' => 'Medical'],
			['type_name' => 'Components'],
			['type_name' => 'Tools'],
			['type_name' => 'Vehicles'],
			['type_name' => 'Packs'],
        ];
    }
}
