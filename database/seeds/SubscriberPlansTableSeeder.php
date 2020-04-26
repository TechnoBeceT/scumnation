<?php

use App\Models\Finance\SubscriberPlan;
use Illuminate\Database\Seeder;
use App\Http\Controllers\Finance\StripeController;

class SubscriberPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // $stripeController = new StripeController;
        // $stripeController->deletePlan('vip1');
        // $stripeController->deletePlan('vip2');
        // $stripeController->deletePlan('vip3');
        // $stripeController->deletePlan('vip4');
        $plans = [
			['name' => 'Bambi', 'price' => 5.00, 'tier' => 'vip1', 'description' => 'Bambi Package'],
			['name' => 'Scum Bag', 'price' => 10.00, 'tier' => 'vip2', 'description' => 'Scum Bag Package'],
			['name' => 'Total Scum', 'price' => 25.00, 'tier' => 'vip3', 'description' => 'Total Scum Package'],
			['name' => 'BROnator', 'price' => 40.00, 'tier' => 'vip4', 'description' => 'BROnator Package']
        ];
        foreach ($plans as $key => $plan) {
			SubscriberPlan::create($plan);
		}
    }
}
