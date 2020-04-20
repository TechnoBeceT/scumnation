<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\SubscriberPlanContent;
use App\Models\Finance\SubscriptionDeploy;
use App\Models\Trading\Item;
use Illuminate\Http\Request;

class SubscriptionDeployController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $deployment = SubscriptionDeploy::where('user_id', $user->id)->where('subscription_id', $user->subscription->id)->first();
        if($deployment) {
            $deployDate = \Carbon\Carbon::createFromTimeStamp(strtotime($deployment->date));
            $diff_in_days = $deployDate->diffInDays(now());
        }else {
            try {
                $contents = $user->subscription->plan->contents;
                $deployed = [];
                foreach ($contents as $key => $content) {
                    switch ($content->type) {
                        case SubscriberPlanContent::FAMEPOINT:
                            $user->addFame($content->amount);
                            $deployed[] = ['Fame Point', $content->amount];
                            break;
                        case SubscriberPlanContent::PACK:
                            break;
                        case SubscriberPlanContent::COIN:
                            $user->addCredits($content->amount);
                            $deployed[] = ['Credits', $content->amount];
                            break;
                        case SubscriberPlanContent::VEHICLE:
                            for($i = 1; ; $i++) {
                                if ($i > $content->amount) {break;}
                                $item = Item::where('category_id', 48)->orWhere('category_id', 49)->orWhere('category_id', 50)->inRandomOrder()->first();
                                $user->addItem($item->id, 1);
                                $deployed[] = [$item->item_name, 1];
                            }
                            break;
                        case SubscriberPlanContent::ITEM:
                            $user->addItem($content->item_id, $content->amount);
                            $deployed[] = [$content->item->item_name, $content->amount];
                            break;
                    }
                }
                return $deployed;
                SubscriptionDeploy::create([
                    'user_id'           => $user->id,
                    'subscription_id'   => $user->subscription->id,
                    'date'              => now()
                ]);
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }
}
