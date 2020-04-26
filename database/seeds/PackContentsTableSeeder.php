<?php

use App\Models\Trading\PackContent;
use Illuminate\Database\Seeder;

class PackContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packContents = [

            //M82A1 Black PACK
			['pack_id' => 1, 'item_id' => 91, 'amount' => 1],  // M82A1 Black
			['pack_id' => 1, 'item_id' => 128, 'amount' => 1], // M82 Suppressor Black
			['pack_id' => 1, 'item_id' => 154, 'amount' => 1], // M82 Scope Black
			['pack_id' => 1, 'item_id' => 116, 'amount' => 3], // M82A1 Magazine
			['pack_id' => 1, 'item_id' => 885, 'amount' => 3], // .50 BMG Ammunition Box
			['pack_id' => 1, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 1, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 1, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //M82A1 Desert PACK
            ['pack_id' => 2, 'item_id' => 92, 'amount' => 1],  // M82A1 Desert
			['pack_id' => 2, 'item_id' => 129, 'amount' => 1], // M82 Suppressor Desert
			['pack_id' => 2, 'item_id' => 155, 'amount' => 1], // M82 Scope Desert
			['pack_id' => 2, 'item_id' => 116, 'amount' => 3], // M82A1 Magazine
			['pack_id' => 2, 'item_id' => 885, 'amount' => 3], // .50 BMG Ammunition Box
			['pack_id' => 2, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 2, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 2, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //M82A1 Snow PACK
            ['pack_id' => 3, 'item_id' => 93, 'amount' => 1],  // M82A1 Snow
			['pack_id' => 3, 'item_id' => 130, 'amount' => 1], // M82 Suppressor Snow
			['pack_id' => 3, 'item_id' => 156, 'amount' => 1], // M82 Scope Snow
			['pack_id' => 3, 'item_id' => 116, 'amount' => 3], // M82A1 Magazine
			['pack_id' => 3, 'item_id' => 885, 'amount' => 3], // .50 BMG Ammunition Box
			['pack_id' => 3, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 3, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 3, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //SVD PACK
            ['pack_id' => 4, 'item_id' => 94, 'amount' => 1],  // SVD
			['pack_id' => 4, 'item_id' => 133, 'amount' => 1], // SVD Suppressor
			['pack_id' => 4, 'item_id' => 158, 'amount' => 1], // POSP 4x24V
			['pack_id' => 4, 'item_id' => 119, 'amount' => 3], // SVD Magazine
			['pack_id' => 4, 'item_id' => 880, 'amount' => 1], // 7.62x54mmR Ammunition Box
			['pack_id' => 4, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 4, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 4, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //AK-47 PACK
            ['pack_id' => 5, 'item_id' => 96, 'amount' => 1],  // AK-47
            ['pack_id' => 5, 'item_id' => 120, 'amount' => 1], // AK15 Suppressor
            ['pack_id' => 5, 'item_id' => 137, 'amount' => 1], // RIS Adapter
            ['pack_id' => 5, 'item_id' => 150, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 5, 'item_id' => 108, 'amount' => 3], // AK-47 Magazine
            ['pack_id' => 5, 'item_id' => 889, 'amount' => 3], // 7.62x39mm Ammunition Box
			['pack_id' => 5, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 5, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 5, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //AK-47 Engraved PACK
            ['pack_id' => 6, 'item_id' => 97, 'amount' => 1],  // AK-47 Engraved
            ['pack_id' => 6, 'item_id' => 120, 'amount' => 1], // AK15 Suppressor
            ['pack_id' => 6, 'item_id' => 137, 'amount' => 1], // RIS Adapter
            ['pack_id' => 6, 'item_id' => 147, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 6, 'item_id' => 108, 'amount' => 3], // AK-47 Magazine
            ['pack_id' => 6, 'item_id' => 889, 'amount' => 3], // 7.62x39mm Ammunition Box
			['pack_id' => 6, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 6, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 6, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //AKM PACK
            ['pack_id' => 7, 'item_id' => 98, 'amount' => 1],  // AKM
            ['pack_id' => 7, 'item_id' => 120, 'amount' => 1], // AK15 Suppressor
            ['pack_id' => 7, 'item_id' => 137, 'amount' => 1], // RIS Adapter
            ['pack_id' => 7, 'item_id' => 147, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 7, 'item_id' => 108, 'amount' => 3], // AK-47 Magazine
            ['pack_id' => 7, 'item_id' => 889, 'amount' => 3], // 7.62x39mm Ammunition Box
			['pack_id' => 7, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 7, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 7, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //MK18 PACK
            ['pack_id' => 8, 'item_id' => 102, 'amount' => 1], // MK18
            ['pack_id' => 8, 'item_id' => 131, 'amount' => 1], // MK18 Suppressor
            ['pack_id' => 8, 'item_id' => 147, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 8, 'item_id' => 115, 'amount' => 3], // M16 Magazine
            ['pack_id' => 8, 'item_id' => 900, 'amount' => 3], // 5.56x45mm Ammunition Box
			['pack_id' => 8, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 8, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 8, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //M16A4 PACK
            ['pack_id' => 9, 'item_id' => 101, 'amount' => 1], // M16A4
            ['pack_id' => 9, 'item_id' => 131, 'amount' => 1], // MK18 Suppressor
            ['pack_id' => 9, 'item_id' => 147, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 9, 'item_id' => 115, 'amount' => 3], // M16 Magazine
            ['pack_id' => 9, 'item_id' => 900, 'amount' => 3], // 5.56x45mm Ammunition Box
			['pack_id' => 9, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 9, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 9, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //Close Combat PACK
            ['pack_id' => 10, 'item_id' => 85, 'amount' => 1],  // SDASS
            ['pack_id' => 10, 'item_id' => 147, 'amount' => 1], // Red Dot Sight
            ['pack_id' => 10, 'item_id' => 871, 'amount' => 3], // Shotgun Ammunition Box
			['pack_id' => 10, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 10, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 10, 'item_id' => 814, 'amount' => 1], // Advanced Compass

            //Snow Camo PACK
            ['pack_id' => 11, 'item_id' => 172, 'amount' => 1],  // Combat Helmet Snow Camo
            ['pack_id' => 11, 'item_id' => 296, 'amount' => 1],  // Armor Tactical Vest White
            ['pack_id' => 11, 'item_id' => 470, 'amount' => 1],  // Tactical Gloves White
            ['pack_id' => 11, 'item_id' => 490, 'amount' => 1],  // Tactical Military Pants Snow Camo
            ['pack_id' => 11, 'item_id' => 545, 'amount' => 1],  // Hiking Boots Snow Camo
            ['pack_id' => 11, 'item_id' => 439, 'amount' => 1],  // Tactical Sweater White
            ['pack_id' => 11, 'item_id' => 338, 'amount' => 1],  // Camouflage Hiking Backpack Snow Camo

            //Desert Camo PACK
            ['pack_id' => 12, 'item_id' => 170, 'amount' => 1],  // Combat Helmet Dark Green
            ['pack_id' => 12, 'item_id' => 297, 'amount' => 1],  // Armor Tactical Vest Tan
            ['pack_id' => 12, 'item_id' => 471, 'amount' => 1],  // Tactical Gloves Tan
            ['pack_id' => 12, 'item_id' => 493, 'amount' => 1],  // Tactical Military Pants Desert Camo
            ['pack_id' => 12, 'item_id' => 542, 'amount' => 1],  // Hiking Boots Brown
            ['pack_id' => 12, 'item_id' => 437, 'amount' => 1],  // Tactical Sweater Tan
            ['pack_id' => 12, 'item_id' => 341, 'amount' => 1],  // Camouflage Hiking Backpack Desert Camo

            //Forest Camo PACK
            ['pack_id' => 13, 'item_id' => 171, 'amount' => 1],  // Combat Helmet Forest Camo
            ['pack_id' => 13, 'item_id' => 298, 'amount' => 1],  // Armor Tactical Vest Green
            ['pack_id' => 13, 'item_id' => 474, 'amount' => 1],  // Tactical Gloves Dark Green
            ['pack_id' => 13, 'item_id' => 489, 'amount' => 1],  // Tactical Military Pants Woodland Camo
            ['pack_id' => 13, 'item_id' => 543, 'amount' => 1],  // Hiking Boots Green
            ['pack_id' => 13, 'item_id' => 436, 'amount' => 1],  // Tactical Sweater Dark Green
            ['pack_id' => 13, 'item_id' => 337, 'amount' => 1],  // Camouflage Hiking Backpack Woodland Camo

            //Black Camo PACK
            ['pack_id' => 14, 'item_id' => 173, 'amount' => 1],  // Combat Helmet Black
            ['pack_id' => 14, 'item_id' => 295, 'amount' => 1],  // Armor Tactical Vest Black
            ['pack_id' => 14, 'item_id' => 468, 'amount' => 1],  // Tactical Gloves Black
            ['pack_id' => 14, 'item_id' => 528, 'amount' => 1],  // Work Pants Black
            ['pack_id' => 14, 'item_id' => 544, 'amount' => 1],  // Hiking Boots Black
            ['pack_id' => 14, 'item_id' => 435, 'amount' => 1],  // Tactical Sweater Black
            ['pack_id' => 14, 'item_id' => 347, 'amount' => 1],  // Hiking Backpack Black

            //Medical Pack
            ['pack_id' => 15, 'item_id' => 722, 'amount' => 4],  // Emergency Bandage Pack
            ['pack_id' => 15, 'item_id' => 726, 'amount' => 3],  // Vitamin Pils 10 Pack
            ['pack_id' => 15, 'item_id' => 729, 'amount' => 3],  // Quinine Sulphate Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 732, 'amount' => 3],  // Potassium Iodide Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 735, 'amount' => 3],  // Anti-Radiation Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 738, 'amount' => 3],  // Antibiotics 10 Pack
            ['pack_id' => 15, 'item_id' => 741, 'amount' => 3],  // Antimalaria Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 747, 'amount' => 3],  // Antipsychotic Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 748, 'amount' => 1],  // Aspirin 20 Pack
            ['pack_id' => 15, 'item_id' => 749, 'amount' => 3],  // Beepollen Pills 10 Pack
            ['pack_id' => 15, 'item_id' => 752, 'amount' => 2],  // Adrenaline Shot
            ['pack_id' => 15, 'item_id' => 753, 'amount' => 2],  // Atropine Injection

            //Crafting Pack
            ['pack_id' => 16, 'item_id' => 794, 'amount' => 10],  // Metal Scrap 1
            ['pack_id' => 16, 'item_id' => 792, 'amount' => 10],  // Lead Plate
            ['pack_id' => 16, 'item_id' => 790, 'amount' => 10],  // Gun Powder
            ['pack_id' => 16, 'item_id' => 799, 'amount' => 10],  // Nails
            ['pack_id' => 16, 'item_id' => 832, 'amount' => 4],  // Sewing Kit 30 Uses
            ['pack_id' => 16, 'item_id' => 834, 'amount' => 4],  // Tool Box 100 Uses
            ['pack_id' => 16, 'item_id' => 32, 'amount' => 2],  // Axe
            ['pack_id' => 16, 'item_id' => 48, 'amount' => 2],  // Shovel

            //Starter Pack
            ['pack_id' => 17, 'item_id' => 722, 'amount' => 1],  // Emergency Bandage Pack
            ['pack_id' => 17, 'item_id' => 752, 'amount' => 1],  // Adrenaline Shot
            ['pack_id' => 17, 'item_id' => 832, 'amount' => 1],  // Sewing Kit 30 Uses
            ['pack_id' => 17, 'item_id' => 834, 'amount' => 1],  // Tool Box 100 Uses
            ['pack_id' => 17, 'item_id' => 32, 'amount' => 1],  // Axe
            ['pack_id' => 17, 'item_id' => 48, 'amount' => 1],  // Shovel
            ['pack_id' => 17, 'item_id' => 96, 'amount' => 1],  // AK-47
            ['pack_id' => 17, 'item_id' => 120, 'amount' => 1], // AK15 Suppressor
            ['pack_id' => 17, 'item_id' => 137, 'amount' => 1], // RIS Adapter
            ['pack_id' => 17, 'item_id' => 150, 'amount' => 1], // ACOG
            ['pack_id' => 17, 'item_id' => 108, 'amount' => 3], // AK-47 Magazine
            ['pack_id' => 17, 'item_id' => 889, 'amount' => 3], // 7.62x39mm Ammunition Box
			['pack_id' => 17, 'item_id' => 672, 'amount' => 2], // Beef Stew MRE
			['pack_id' => 17, 'item_id' => 704, 'amount' => 1], // Water Bottle
            ['pack_id' => 17, 'item_id' => 814, 'amount' => 1], // Advanced Compass
            ['pack_id' => 17, 'item_id' => 173, 'amount' => 1],  // Combat Helmet Black
            ['pack_id' => 17, 'item_id' => 295, 'amount' => 1],  // Armor Tactical Vest Black
            ['pack_id' => 17, 'item_id' => 468, 'amount' => 1],  // Tactical Gloves Black
            ['pack_id' => 17, 'item_id' => 528, 'amount' => 1],  // Work Pants Black
            ['pack_id' => 17, 'item_id' => 544, 'amount' => 1],  // Hiking Boots Black
            ['pack_id' => 17, 'item_id' => 435, 'amount' => 1],  // Tactical Sweater Black
            ['pack_id' => 17, 'item_id' => 323, 'amount' => 1],  // Assault Backpack Black
        ];
        foreach ($packContents as $key => $packContent) {
			PackContent::create($packContent);
		}
    }
}
