<?php

namespace App\Console\Commands;

use App\Models\Finance\SubscriberPlanContent;
use App\Models\Finance\SubscriptionDeploy;
use App\Models\Finance\Subscriptions;
use App\Models\Trading\Item;
use App\Models\Trading\Pack;
use App\Models\Users\User;
use Illuminate\Console\Command;

class GiveWeeklyItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:giveWeeklyItems';

     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give weekly items to subscribed users.';

    protected $chunkSize = 100;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subscriptions = Subscriptions::all();
        foreach ($subscriptions as $key => $subscription) {
           $user = User::find($subscription->user_id);
           $contents = $user->subscription->plan->contents;
                foreach ($contents as $key => $content) {
                    switch ($content->type) {
                        case SubscriberPlanContent::FAMEPOINT:
                            $user->addFame($content->amount);
                            break;
                        case SubscriberPlanContent::PACK:
                            for($i = 1; ; $i++) {
                                if ($i > $content->amount) {break;}
                                $pack = Pack::where('category_id', $content->pack_type_id)->inRandomOrder()->first();
                                foreach ($pack->contents as $packContent) {
                                    $user->addItem($packContent->item_id, $packContent->amount);
                                }
                            }
                            break;
                        case SubscriberPlanContent::COIN:
                            $user->addCredits($content->amount);
                            break;
                        case SubscriberPlanContent::VEHICLE:
                            for($i = 1; ; $i++) {
                                if ($i > $content->amount) {break;}
                                $item = Item::where('category_id', 48)->orWhere('category_id', 49)->orWhere('category_id', 50)->inRandomOrder()->first();
                                $user->addItem($item->id, 1);
                            }
                            break;
                        case SubscriberPlanContent::ITEM:
                            $user->addItem($content->item_id, $content->amount);
                            break;
                    }
                }
                SubscriptionDeploy::create([
                    'user_id'           => $user->id,
                    'subscription_id'   => $user->subscription->id,
                    'date'              => now()
                ]);
        }
    }
}
