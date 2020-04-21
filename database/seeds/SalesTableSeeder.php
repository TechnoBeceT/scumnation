<?php

use App\Models\Trading\Sale;
use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales = [
					// Weapons
					// Assault Rifles
						['item_id' => 95, 'price' => 150.00, 'daily_limit' => 0], //AK-15
						['item_id' => 96, 'price' => 150.00, 'daily_limit' => 0], //AK-47 
						['item_id' => 97, 'price' => 170.00, 'daily_limit' => 0], //AK-47 Engraved
						['item_id' => 98, 'price' => 150.00, 'daily_limit' => 0], //AKM 
						['item_id' => 101, 'price' => 150.00, 'daily_limit' => 0], //M16
						['item_id' => 102, 'price' => 450.00, 'daily_limit' => 0], //MK18

					// SMG
						['item_id' => 99, 'price' => 120.00, 'daily_limit' => 0], //AKS-74U
						['item_id' => 100, 'price' => 120.00, 'daily_limit' => 0], //AS VAL
						['item_id' => 103, 'price' => 120.00, 'daily_limit' => 0], //MP5

					// SNIPER RIFLES
						['item_id' => 90, 'price' => 350.00, 'daily_limit' => 0], //M1 Rifle
						['item_id' => 91, 'price' => 450.00, 'daily_limit' => 0], //M82A1 Black
						['item_id' => 92, 'price' => 450.00, 'daily_limit' => 0], //M82A1 Desert
						['item_id' => 93, 'price' => 450.00, 'daily_limit' => 0], //M82A1 Snow
						['item_id' => 94, 'price' => 325.00, 'daily_limit' => 0], //SVD
						['item_id' => 89, 'price' => 325.00, 'daily_limit' => 0], //M1891
						['item_id' => 88, 'price' => 325.00, 'daily_limit' => 0], //KAR98
						['item_id' => 87, 'price' => 125.00, 'daily_limit' => 0], //HUNTER 85

					// SHOTGUNS
						['item_id' => 86, 'price' => 100.00, 'daily_limit' => 0], //TEC01 490
						['item_id' => 85, 'price' => 150.00, 'daily_limit' => 0], //SDASS
						['item_id' => 84, 'price' => 80.00, 'daily_limit' => 0], //M1887

					// PISTOL
						['item_id' => 81, 'price' => 25.00, 'daily_limit' => 0], //TEC01 M9 Black
						['item_id' => 82, 'price' => 25.00, 'daily_limit' => 0], //TEC01 M9 Silver
						['item_id' => 77, 'price' => 35.00, 'daily_limit' => 0], //BLACK 21
						['item_id' => 78, 'price' => 50.00, 'daily_limit' => 0], //DEagle .357
						['item_id' => 79, 'price' => 50.00, 'daily_limit' => 0], //DEagle .50

					// EXPLOSIVE
						['item_id' => 105, 'price' => 250.00, 'daily_limit' => 2], //Grenade
						['item_id' => 106, 'price' => 25.00, 'daily_limit' => 0],  //Smoke Grenade
						['item_id' => 104, 'price' => 250.00, 'daily_limit' => 0], //Thunder Flash

					//TRAPS
						['item_id' => 160, 'price' => 250.00,  'daily_limit' => 1], //Anti-Personnel Mine
						['item_id' => 168, 'price' => 250.00,  'daily_limit' => 1], //Small Anti-Personnel Mine
						['item_id' => 162, 'price' => 250.00,  'daily_limit' => 1], //Claymore

				// Gear

					// Skid Lids
						['item_id' => 170, 'price' => 15.00, 'daily_limit' => 0], // Combat Helmet Dark Green
						['item_id' => 171, 'price' => 15.00, 'daily_limit' => 0], // Combat Helmet Forest Camo
						['item_id' => 172, 'price' => 15.00, 'daily_limit' => 0], // Combat Helmet Snow Camo
						['item_id' => 173, 'price' => 15.00, 'daily_limit' => 0], // Combat Helmet Black

						['item_id' => 182, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Black
						['item_id' => 183, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Dark Green
						['item_id' => 181, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Desert Camo
						['item_id' => 185, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet MultiCam
						['item_id' => 177, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Scorpion Camo
						['item_id' => 178, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Snow Camo
						['item_id' => 180, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet UCP
						['item_id' => 184, 'price' => 10.00, 'daily_limit' => 0], // Military Helmet Woodland Camo

					// Blag Masks
						['item_id' => 256, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Black
						['item_id' => 262, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Brown
						['item_id' => 260, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Dark Green
						['item_id' => 263, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Green
						['item_id' => 257, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Light Brown
						['item_id' => 259, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Light Grey
						['item_id' => 264, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Navy Blue
						['item_id' => 258, 'price' => 5.00, 'daily_limit' => 0], // Balaclava Tan
						['item_id' => 261, 'price' => 5.00, 'daily_limit' => 0], // Balaclava White

					// Body Armor
						['item_id' => 303, 'price' => 40.00, 'daily_limit' => 0], // Heavy Ballistic Armor
						['item_id' => 302, 'price' => 40.00, 'daily_limit' => 0], // Hard Armor Ballistic Vest
						['item_id' => 301, 'price' => 40.00, 'daily_limit' => 0], // Military Ballistic Vest
						['item_id' => 300, 'price' => 40.00, 'daily_limit' => 0], // Police Tactical Duty Vest

						['item_id' => 295, 'price' => 80.00, 'daily_limit' => 0], // Armor Tactical Vest Black
						['item_id' => 298, 'price' => 80.00, 'daily_limit' => 0], // Armor Tactical Vest Green
						['item_id' => 297, 'price' => 80.00, 'daily_limit' => 0], // Armor Tactical Vest Tan
						['item_id' => 296, 'price' => 80.00, 'daily_limit' => 0], // Armor Tactical Vest White


					// Misc
						['item_id' => 824, 'price' => 5.00, 'daily_limit' => 0], //Military Compass
						['item_id' => 283, 'price' => 35.00, 'daily_limit' => 0], // Night Vision Goggles
						['item_id' => 364, 'price' => 15.00, 'daily_limit' => 0], // Military Quiver

						['item_id' => 290, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Black/Green
						['item_id' => 287, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Black/White
						['item_id' => 291, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Brown
						['item_id' => 292, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Green
						['item_id' => 294, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf MultiCam
						['item_id' => 293, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Red
						['item_id' => 289, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf Red/White
						['item_id' => 288, 'price' => 15.00, 'daily_limit' => 0], // Shemagh Scarf White/Black

					//Backpacks
						['item_id' => 321, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Black
						['item_id' => 313, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Dark Green
						['item_id' => 318, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Desert Camo
						['item_id' => 320, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack MultiCam
						['item_id' => 319, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Navy Blue
						['item_id' => 315, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Snow Camo
						['item_id' => 317, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack UCP
						['item_id' => 314, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Woodland Camo
						['item_id' => 316, 'price' => 25.00, 'daily_limit' => 0], // Assault Backpack Woodland MARPAT

					//Wastemans
						['item_id' => 454, 'price' => 5.00, 'daily_limit' => 0], // Waist Man Black
						['item_id' => 454, 'price' => 5.00, 'daily_limit' => 0], // Waist Man Grey

					// gloves
						['item_id' => 468, 'price' => 5.00, 'daily_limit' => 0], // Tactical Gloves Black
						['item_id' => 476, 'price' => 5.00, 'daily_limit' => 0], // Tactical Gloves Blue
						['item_id' => 474, 'price' => 5.00, 'daily_limit' => 0], // Tactical Gloves Dark Green
						['item_id' => 475, 'price' => 5.00, 'daily_limit' => 0], // Tactical Gloves Grey

					// Jackets
						['item_id' => 366, 'price' => 20.00, 'daily_limit' => 0], // Camouflage Jacket Forest Camo
						['item_id' => 367, 'price' => 20.00, 'daily_limit' => 0], // Camouflage Jacket Navy Camo
						['item_id' => 368, 'price' => 20.00, 'daily_limit' => 0], // Camouflage Jacket Urban Camo

						['item_id' => 426, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Black
						['item_id' => 425, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Dark Green
						['item_id' => 429, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Desert Camo
						['item_id' => 431, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket MultiCam
						['item_id' => 433, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Navy Blue
						['item_id' => 428, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Snow Camo
						['item_id' => 430, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket UCP
						['item_id' => 432, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Urban Camo
						['item_id' => 427, 'price' => 20.00, 'daily_limit' => 0], // Tactical Jacket Woodland Camo

					// pants

						['item_id' => 493, 'price' => 15.00, 'daily_limit' => 0], // Tactical Military Pants Desert Camo
						['item_id' => 491, 'price' => 15.00, 'daily_limit' => 0], // Tactical Military Pants MultiCam
						['item_id' => 490, 'price' => 15.00, 'daily_limit' => 0], // Tactical Jacket Urban Camo
						['item_id' => 492, 'price' => 15.00, 'daily_limit' => 0], // Tactical Military Pants UCP
						['item_id' => 494, 'price' => 15.00, 'daily_limit' => 0], // Tactical Military Pants Urban Camo
						['item_id' => 489, 'price' => 15.00, 'daily_limit' => 0], // Tactical Military Pants Woodland Camo

					// Footwear

						['item_id' => 549, 'price' => 15.00, 'daily_limit' => 0], // Military Boots Black
						['item_id' => 550, 'price' => 15.00, 'daily_limit' => 0], // Military Boots Pink
						['item_id' => 536, 'price' => 15.00, 'daily_limit' => 0], // Combat Boots

					// Medical

						['item_id' => 721, 'price' => 5.00,  'daily_limit' => 1], //Bandage
						['item_id' => 722, 'price' => 15.00,  'daily_limit' => 1], //Bandage Multipack
						['item_id' => 723, 'price' => 25.00,  'daily_limit' => 1], //Painkillers Pills 10 Pack
						['item_id' => 728, 'price' => 25.00,  'daily_limit' => 1], //Vitamin Pils 30 Pack
						['item_id' => 752, 'price' => 50.00,  'daily_limit' => 1], //Adrenaline Shot

					// Food

						['item_id' => 633, 'price' => 15.00, 'daily_limit' => 0], //Almonds
						['item_id' => 614, 'price' => 15.00, 'daily_limit' => 0], //Amanita Pantheria
						['item_id' => 615, 'price' => 15.00, 'daily_limit' => 0], //Amanita Phalloides
						['item_id' => 573, 'price' => 15.00, 'daily_limit' => 0], //Apple Green
						['item_id' => 572, 'price' => 15.00, 'daily_limit' => 0], //Apple Red
						['item_id' => 682, 'price' => 15.00, 'daily_limit' => 0], //Baked Beans
						['item_id' => 574, 'price' => 15.00, 'daily_limit' => 0], //Banana
						['item_id' => 684, 'price' => 15.00, 'daily_limit' => 0], //Beef Ravioli
						['item_id' => 672, 'price' => 15.00, 'daily_limit' => 0], //Beef Stew MRE
						['item_id' => 706, 'price' => 15.00, 'daily_limit' => 0], //Beer
						['item_id' => 683, 'price' => 15.00, 'daily_limit' => 0], //Canned Beef Goulash
						['item_id' => 679, 'price' => 15.00, 'daily_limit' => 0], //Canned Tuna
						['item_id' => 575, 'price' => 15.00, 'daily_limit' => 0], //Cantaloupe Melon
						['item_id' => 576, 'price' => 15.00, 'daily_limit' => 0], //Cantaloupe Melon Slice
						['item_id' => 691, 'price' => 15.00, 'daily_limit' => 0], //Canteen
						['item_id' => 610, 'price' => 15.00, 'daily_limit' => 0], //Cantharellus Cibarius
						['item_id' => 692, 'price' => 15.00, 'daily_limit' => 0], //Caramel Soda 1
						['item_id' => 673, 'price' => 15.00, 'daily_limit' => 0], //Cheeseburger MRE
						['item_id' => 659, 'price' => 15.00, 'daily_limit' => 0], //Chocolate 1
						['item_id' => 660, 'price' => 15.00, 'daily_limit' => 0], //Chocolate 2
						['item_id' => 661, 'price' => 15.00, 'daily_limit' => 0], //Chocolate 3
						['item_id' => 662, 'price' => 15.00, 'daily_limit' => 0], //Chocolate 4
						['item_id' => 599, 'price' => 15.00, 'daily_limit' => 0], //Coconut
						['item_id' => 695, 'price' => 15.00, 'daily_limit' => 0], //Cola
						['item_id' => 594, 'price' => 15.00, 'daily_limit' => 0], //Currant
						['item_id' => 699, 'price' => 15.00, 'daily_limit' => 0], //Lime Soda 2
						['item_id' => 571, 'price' => 15.00, 'daily_limit' => 0], //Zucchini

					// cars

						['item_id' => 846, 'price' => 750.00, 'daily_limit' => 1], //Pickup Black
						['item_id' => 847, 'price' => 750.00, 'daily_limit' => 1], //Pickup Blue
						['item_id' => 850, 'price' => 750.00, 'daily_limit' => 1], //Pickup Forest Camo
						['item_id' => 845, 'price' => 750.00, 'daily_limit' => 1], //Pickup Orange
						['item_id' => 848, 'price' => 750.00, 'daily_limit' => 1], //Pickup Red
						['item_id' => 851, 'price' => 750.00, 'daily_limit' => 1], //Pickup Red/White
						['item_id' => 849, 'price' => 750.00, 'daily_limit' => 1], //Pickup White
						['item_id' => 853, 'price' => 500.00, 'daily_limit' => 1], //Quad Blue
						['item_id' => 855, 'price' => 500.00, 'daily_limit' => 1], //Quad Forest Camo
						['item_id' => 854, 'price' => 500.00, 'daily_limit' => 1], //Quad Red
						['item_id' => 852, 'price' => 500.00, 'daily_limit' => 1], //Quad Yellow
						['item_id' => 844, 'price' => 1000.00, 'daily_limit' => 1], //SUV Black
						['item_id' => 840, 'price' => 1000.00, 'daily_limit' => 1], //SUV Blue
						['item_id' => 841, 'price' => 1000.00, 'daily_limit' => 1], //SUV Orange
						['item_id' => 842, 'price' => 1200.00, 'daily_limit' => 1], //SUV Police
						['item_id' => 843, 'price' => 1400.00, 'daily_limit' => 1], //SUV Police With Accessories

					// Weapon Ting

					// ammo
						['item_id' => 889, 'price' => 50.00, 'daily_limit' => 0], // 7.62x39mm Ammunition Box
						['item_id' => 893, 'price' => 50.00, 'daily_limit' => 0], // 5.45x39mm Ammunition Box
						['item_id' => 900, 'price' => 50.00, 'daily_limit' => 0], // 5.56x45mm Ammunition Box
						['item_id' => 877, 'price' => 50.00, 'daily_limit' => 0], // 7.92x57mm Ammunition Box
						['item_id' => 880, 'price' => 50.00, 'daily_limit' => 0], // 7.62x54mmR Ammunition Box
						['item_id' => 885, 'price' => 150.00, 'daily_limit' => 0], // .50 BMG Ammunition Box
						['item_id' => 871, 'price' => 45.00, 'daily_limit' => 0], // Shotgun Ammunition Box
						['item_id' => 868, 'price' => 45.00, 'daily_limit' => 0], // 9mm Ammunition Box
						['item_id' => 896, 'price' => 50.00, 'daily_limit' => 0], // 9x39mm Ammunition Box
						['item_id' => 859, 'price' => 30.00, 'daily_limit' => 0], // .45 ACP Ammunition Box
						['item_id' => 862, 'price' => 30.00, 'daily_limit' => 0], // .357 Ammunition Box
						['item_id' => 865, 'price' => 30.00, 'daily_limit' => 0], // .50 AE Ammunition Box
						['item_id' => 874, 'price' => 45.00, 'daily_limit' => 0], // .22 Cal Ammunition Box
						['item_id' => 883, 'price' => 50.00, 'daily_limit' => 0], // Cal .30-06 Ammunition Box

					// Scopes 
						['item_id' => 150, 'price' => 10.00, 'daily_limit' => 0], //	ACOG
						['item_id' => 149, 'price' => 10.00, 'daily_limit' => 0], //	XPS Holographic Sight
						['item_id' => 159, 'price' => 10.00, 'daily_limit' => 0], //	ZF39
						['item_id' => 145, 'price' => 10.00, 'daily_limit' => 0], //	MRO Red Dot Sight
						['item_id' => 146, 'price' => 10.00, 'daily_limit' => 0], //	OKP Holographic Sight
						['item_id' => 157, 'price' => 20.00, 'daily_limit' => 0], //	P-223 Scope
						['item_id' => 158, 'price' => 20.00, 'daily_limit' => 0], //	POSP 4x24V
						['item_id' => 147, 'price' => 20.00, 'daily_limit' => 0], //	Red Dot Sight
						['item_id' => 148, 'price' => 20.00, 'daily_limit' => 0], //	V3 Holographic Sight

						['item_id' => 107, 'price' => 20.00, 'daily_limit' => 0], //	AK15 Magazine
						['item_id' => 120, 'price' => 20.00, 'daily_limit' => 0], //	AK15 Suppressor
						['item_id' => 119, 'price' => 25.00, 'daily_limit' => 0], //	SVD Magazine
						['item_id' => 133, 'price' => 25.00, 'daily_limit' => 0], //	SVD Suppressor
						['item_id' => 137, 'price' => 25.00, 'daily_limit' => 0], //	RIS Adapter

						['item_id' => 108, 'price' => 20.00, 'daily_limit' => 0], //	AK47 Magazine

						['item_id' => 115, 'price' => 20.00, 'daily_limit' => 0], //	M16 Magazine
						['item_id' => 131, 'price' => 20.00, 'daily_limit' => 0], //	MK18 Suppressor

						['item_id' => 109, 'price' => 10.00, 'daily_limit' => 0], //	AKS-74U Magazine

						['item_id' => 110, 'price' => 10.00, 'daily_limit' => 0], //	AS Val Magazine

						['item_id' => 111, 'price' => 10.00, 'daily_limit' => 0], //	Block 21 Magazine

						['item_id' => 112, 'price' => 10.00, 'daily_limit' => 0], //	DEagle .357 Magazine
						['item_id' => 113, 'price' => 10.00, 'daily_limit' => 0], //	DEagle .50 Magazine
						['item_id' => 142, 'price' => 10.00, 'daily_limit' => 0], //	Desert Eagle Red Dot

						['item_id' => 151, 'price' => 20.00, 'daily_limit' => 0], //	Hunting Scope

						['item_id' => 114, 'price' => 20.00, 'daily_limit' => 0], //	M1 Clip
						['item_id' => 143, 'price' => 20.00, 'daily_limit' => 0], //	M1 Experimental Sights
						['item_id' => 153, 'price' => 20.00, 'daily_limit' => 0], //	M1 Scope
						['item_id' => 127, 'price' => 20.00, 'daily_limit' => 0], //	M1 Suppressor

						['item_id' => 116, 'price' => 50.00, 'daily_limit' => 0], //	M82A1 Magazine
						['item_id' => 154, 'price' => 40.00, 'daily_limit' => 0], //	M82 Scope Black
						['item_id' => 155, 'price' => 40.00, 'daily_limit' => 0], //	M82 Scope Desert
						['item_id' => 156, 'price' => 40.00, 'daily_limit' => 0], //	M82 Scope Snow
						['item_id' => 128, 'price' => 40.00, 'daily_limit' => 0], //	M82 Suppressor Black
						['item_id' => 129, 'price' => 40.00, 'daily_limit' => 0], //	M82 Suppressor Desert
						['item_id' => 130, 'price' => 40.00, 'daily_limit' => 0], //	M82 Suppressor Snow

						['item_id' => 117, 'price' => 10.00, 'daily_limit' => 0], //	M9 Magazine
						['item_id' => 121, 'price' => 10.00, 'daily_limit' => 0], //	M9 Suppressor

						['item_id' => 118, 'price' => 15.00, 'daily_limit' => 0], //	MP5 Magazine
						['item_id' => 136, 'price' => 15.00, 'daily_limit' => 0], //	MP5 Rail
						['item_id' => 132, 'price' => 15.00, 'daily_limit' => 0], //	MP5 Suppressor

						['item_id' => 64, 'price' => 10.00, 'daily_limit' => 0], //Compound Bow Sight 3 Pin
						['item_id' => 65, 'price' => 10.00, 'daily_limit' => 0], //Compound Bow Sight 5 Pin
						['item_id' => 67, 'price' => 10.00, 'daily_limit' => 0], //Improvised Bow Stabiliser
						['item_id' => 66, 'price' => 10.00, 'daily_limit' => 0], //Slip-On Bow Silencer
						['item_id' => 73, 'price' => 10.00, 'daily_limit' => 0], //Wooden Arrow
						['item_id' => 74, 'price' => 10.00, 'daily_limit' => 0], //Wooden Arrow Feathers
						['item_id' => 75, 'price' => 10.00, 'daily_limit' => 0], //Wooden Arrow Metal Tip
						['item_id' => 76, 'price' => 10.00, 'daily_limit' => 0], //Wooden Arrow Stone Tip
						['item_id' => 69, 'price' => 10.00, 'daily_limit' => 0], //Broadhead Carbon Arrow
						['item_id' => 70, 'price' => 10.00, 'daily_limit' => 0], //Broadhead Metal Arrow
						['item_id' => 72, 'price' => 10.00, 'daily_limit' => 0], //Metal Arrow
						['item_id' => 71, 'price' => 10.00, 'daily_limit' => 0], //Carbon_Arrow
        ];

			foreach ($sales as $key => $sale) {
				Sale::create($sale);
			}
    }
}
