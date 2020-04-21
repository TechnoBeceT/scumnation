<?php

use App\Models\Finance\SubscriberPlanContent;
use Illuminate\Database\Seeder;

class SubscriberPlanContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contents = [
            ['plan_id' => 1, 'type' => SubscriberPlanContent::FAMEPOINT, 'amount' => 250, 'days' => 7],
            ['plan_id' => 1, 'type' => SubscriberPlanContent::COIN, 'amount' => 250, 'days' => 7],
            ['plan_id' => 2, 'type' => SubscriberPlanContent::FAMEPOINT, 'amount' => 300, 'days' => 7],
            ['plan_id' => 2, 'type' => SubscriberPlanContent::COIN, 'amount' => 500, 'days' => 7],
            ['plan_id' => 2, 'type' => SubscriberPlanContent::PACK, 'amount' => 2, 'pack_type_id' => 53, 'days' => 7],
            ['plan_id' => 2, 'type' => SubscriberPlanContent::VEHICLE, 'amount' => 1, 'days' => 7],
            ['plan_id' => 3, 'type' => SubscriberPlanContent::FAMEPOINT, 'amount' => 750, 'days' => 7],
            ['plan_id' => 3, 'type' => SubscriberPlanContent::COIN, 'amount' => 1000, 'days' => 7],
            ['plan_id' => 3, 'type' => SubscriberPlanContent::PACK, 'amount' => 3, 'pack_type_id' => 53, 'days' => 7],
            ['plan_id' => 3, 'type' => SubscriberPlanContent::VEHICLE, 'amount' => 2, 'days' => 7],
            ['plan_id' => 3, 'type' => SubscriberPlanContent::ITEM, 'amount' => 2, 'item_id' => 813, 'days' => 7],
            ['plan_id' => 4, 'type' => SubscriberPlanContent::FAMEPOINT, 'amount' => 750, 'days' => 7],
            ['plan_id' => 4, 'type' => SubscriberPlanContent::COIN, 'amount' => 1500, 'days' => 7],
            ['plan_id' => 4, 'type' => SubscriberPlanContent::PACK, 'amount' => 10, 'pack_type_id' => 53, 'days' => 7],
            ['plan_id' => 4, 'type' => SubscriberPlanContent::VEHICLE, 'amount' => 5, 'days' => 7],
            ['plan_id' => 4, 'type' => SubscriberPlanContent::ITEM, 'amount' => 3, 'item_id' => 813, 'days' => 7],
            
        ];
        foreach ($contents as $key => $content) {
			SubscriberPlanContent::create($content);
		}
    }
}
