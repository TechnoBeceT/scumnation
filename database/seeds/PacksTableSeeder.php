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
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Black', 'pack_image' => url('/images/packs/M82A1_Lover_Pack_Black.png')],
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Desert', 'pack_image' => url('/images/packs/M82A1_Lover_Pack_Desert.png')],
			['category_id' => 53, 'pack_name' => 'M82A1 Lover Pack Snow', 'pack_image' => url('/images/packs/M82A1_Lover_Pack_Desert.png')],
			['category_id' => 53, 'pack_name' => 'SVD Lover Pack', 'pack_image' => url('/images/packs/SVD_Lover_Pack.png')],
			['category_id' => 53, 'pack_name' => 'AK47 Lover Pack', 'pack_image' => url('/images/packs/AK47_Lover_Pack.png.png')],
            ['category_id' => 53, 'pack_name' => 'AK47 Lover Pack Engraved', 'pack_image' => url('/images/packs/AK47_Engraved_Lover_Pack.png')],
            ['category_id' => 53, 'pack_name' => 'AKM Lover Pack', 'pack_image' => url('/images/packs/AKM_Lover_Pack.png')],
			['category_id' => 53, 'pack_name' => 'MK18 Lover Pack', 'pack_image' => url('/images/packs/MK18_Lover_Pack.png')],
			['category_id' => 53, 'pack_name' => 'M16A4 Lover Pack', 'pack_image' => url('/images/packs/M16A4_Lover_Pack.png')],
            ['category_id' => 53, 'pack_name' => 'Close Combat Pack', 'pack_image' => url('/images/packs/Close_Combat_Pack.png')],
            ['category_id' => 55, 'pack_name' => 'Snow Camouflage Pack', 'pack_image' => url('/images/packs/Snow_Camo_Pack.png')],
            ['category_id' => 55, 'pack_name' => 'Desert Camouflage Pack', 'pack_image' => url('/images/packs/Desert_Camo_Pack.png')],
            ['category_id' => 55, 'pack_name' => 'Forest Camouflage Pack', 'pack_image' => url('/images/packs/Forest_Camo_Pack.png')],
            ['category_id' => 55, 'pack_name' => 'Black Camouflage Pack', 'pack_image' => url('/images/packs/Black_Camo_Pack.png')],
            ['category_id' => 54, 'pack_name' => 'Medical Package', 'pack_image' => url('/images/packs/Medical_Pack.png')],
            ['category_id' => 54, 'pack_name' => 'Crafting Package', 'pack_image' => url('/images/packs/Crafting_Pack.png')],
        ];
        foreach ($packs as $key => $pack) {
			Pack::create($pack);
		}
    }
}
