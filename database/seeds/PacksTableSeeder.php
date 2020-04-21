<?php

use App\Models\Trading\Pack;
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
        $packs = [
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Black'],
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Desert'],
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Snow'],
			['category_id' => 53, 'pack_name' => 'SVD Lover Pack'],
			['category_id' => 53, 'pack_name' => 'AK47 Lover Pack'],
            ['category_id' => 53, 'pack_name' => 'AK47 Lover Pack Engraved'],
            ['category_id' => 53, 'pack_name' => 'AKM Lover Pack'],
			['category_id' => 53, 'pack_name' => 'MK18 Lover Pack'],
			['category_id' => 53, 'pack_name' => 'M16A4 Lover Pack'],
            ['category_id' => 53, 'pack_name' => 'Close Combat Pack'],
            ['category_id' => 55, 'pack_name' => 'Snow Camouflage Pack'],
            ['category_id' => 55, 'pack_name' => 'Desert Camouflage Pack'],
            ['category_id' => 55, 'pack_name' => 'Forest Camouflage Pack'],
            ['category_id' => 55, 'pack_name' => 'Black Camouflage Pack'],
            ['category_id' => 54, 'pack_name' => 'Medical Package'],
            ['category_id' => 54, 'pack_name' => 'Crafting Package'],
        ];
        foreach ($packs as $key => $pack) {
			Pack::create($pack);
		}
    }
}
