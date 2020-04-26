<?php

use App\Models\Trading\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
			['category_type' => 1, 'category_name' => 'One Handed'],
			['category_type' => 1, 'category_name' => 'Two Handed'],
			['category_type' => 1, 'category_name' => 'Bows'],
			['category_type' => 1, 'category_name' => 'Bow Attchments'],
			['category_type' => 1, 'category_name' => 'Arrows'],
			['category_type' => 1, 'category_name' => 'Handguns'],
			['category_type' => 1, 'category_name' => 'Shotguns'],
			['category_type' => 1, 'category_name' => 'Rifles'],
			['category_type' => 1, 'category_name' => 'Grenades'],
			['category_type' => 1, 'category_name' => 'Magazines'],
			['category_type' => 1, 'category_name' => 'Suppressors'],
			['category_type' => 1, 'category_name' => 'Rails'],
			['category_type' => 1, 'category_name' => 'Flashlights'],
			['category_type' => 1, 'category_name' => 'Sights'],
			['category_type' => 1, 'category_name' => 'Scopes'],
			['category_type' => 1, 'category_name' => 'Traps'],
			['category_type' => 2, 'category_name' => 'Head Armor'],
			['category_type' => 2, 'category_name' => 'Hats'],
			['category_type' => 2, 'category_name' => 'Masks'],
			['category_type' => 2, 'category_name' => 'Eyes'],
			['category_type' => 2, 'category_name' => 'Neck'],
			['category_type' => 2, 'category_name' => 'Chest Armor'],
			['category_type' => 2, 'category_name' => 'Backpacks'],
			['category_type' => 2, 'category_name' => 'Quivers'],
			['category_type' => 2, 'category_name' => 'Tops'],
			['category_type' => 2, 'category_name' => 'Waist'],
			['category_type' => 2, 'category_name' => 'Hands'],
			['category_type' => 2, 'category_name' => 'Legs'],
			['category_type' => 2, 'category_name' => 'Feet'],
			['category_type' => 3, 'category_name' => 'Vegetables'],
			['category_type' => 3, 'category_name' => 'Fruits'],
			['category_type' => 3, 'category_name' => 'Berries'],
			['category_type' => 3, 'category_name' => 'Nuts & Seeds'],
			['category_type' => 3, 'category_name' => 'Wild Plants'],
			['category_type' => 3, 'category_name' => 'Mushrooms'],
			['category_type' => 3, 'category_name' => 'Animal Products'],
			['category_type' => 3, 'category_name' => 'Packaged Foods'],
			['category_type' => 3, 'category_name' => 'Canned Foods'],
			['category_type' => 3, 'category_name' => 'Drinks'],
			['category_type' => 4, 'category_name' => 'Bandages'],
			['category_type' => 4, 'category_name' => 'Pills'],
			['category_type' => 4, 'category_name' => 'Other'],
			['category_type' => 5, 'category_name' => 'Natural'],
			['category_type' => 5, 'category_name' => 'Man-Made'],
			['category_type' => 6, 'category_name' => 'Tools'],
			['category_type' => 6, 'category_name' => 'Repair'],
			['category_type' => 6, 'category_name' => 'Music'],
			['category_type' => 7, 'category_name' => 'SUVs'],
			['category_type' => 7, 'category_name' => 'Pickups'],
			['category_type' => 7, 'category_name' => 'Quads'],
			['category_type' => 7, 'category_name' => 'Other'],
			['category_type' => 1, 'category_name' => 'Ammunition'],
			['category_type' => 8, 'category_name' => 'Weapon Packs', 'content' => Category::PACK],
			['category_type' => 8, 'category_name' => 'Other Packs', 'content' => Category::PACK],
			['category_type' => 8, 'category_name' => 'Armor Packs', 'content' => Category::PACK]
        ];
        foreach ($categories as $key => $category) {
			Category::create($category);
		}
    }
}
