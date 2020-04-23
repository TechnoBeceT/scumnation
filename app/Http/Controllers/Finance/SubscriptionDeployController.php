<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\SubscriberPlanContent;
use App\Models\Finance\SubscriptionDeploy;
use App\Models\Trading\Item;
use App\Models\Trading\Pack;
use App\Traits\ApiResponser;

class SubscriptionDeployController extends Controller
{
    use ApiResponser;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $deployment = SubscriptionDeploy::where('user_id', $user->id)->where('subscription_id', $user->subscription->id)->orderBy('date', 'desc')->first();
        if($deployment) {
            $deployDate = \Carbon\Carbon::createFromTimeStamp(strtotime($deployment->date));
            $diff_in_days = $deployDate->diffInDays(now());
            if($diff_in_days >= 7) {
                try {
                    $contents = $user->subscription->plan->contents;
                    $deployed = [];
                    foreach ($contents as $key => $content) {
                        switch ($content->type) {
                            case SubscriberPlanContent::FAMEPOINT:
                                $user->addFame($content->amount);
                                $deployed[] = ['name' => 'Fame Point', 'amount' => $content->amount];
                                break;
                            case SubscriberPlanContent::PACK:
                                for($i = 1; ; $i++) {
                                    if ($i > $content->amount) {break;}
                                    $pack = Pack::where('category_id', $content->pack_type_id)->inRandomOrder()->first();
                                    foreach ($pack->contents as $packContent) {
                                        $user->addItem($packContent->item_id, $packContent->amount);
                                        $deployed[] = ['name' => $packContent->item->item_name, 'amount' => $packContent->amount];
                                    }
                                }
                                break;
                            case SubscriberPlanContent::COIN:
                                $user->addCredits($content->amount);
                                $deployed[] = ['name' => 'Credits', 'amount' => $content->amount];
                                break;
                            case SubscriberPlanContent::VEHICLE:
                                for($i = 1; ; $i++) {
                                    if ($i > $content->amount) {break;}
                                    $item = Item::where('category_id', 48)->orWhere('category_id', 49)->orWhere('category_id', 50)->inRandomOrder()->first();
                                    $user->addItem($item->id, 1);
                                    $deployed[] = ['name' => $item->item_name, 'amount' => 1];
                                }
                                break;
                            case SubscriberPlanContent::ITEM:
                                $user->addItem($content->item_id, $content->amount);
                                $deployed[] = ['name' => $content->item->item_name, 'amount' => $content->amount];
                                break;
                        }
                    }
                    SubscriptionDeploy::create([
                        'user_id'           => $user->id,
                        'subscription_id'   => $user->subscription->id,
                        'date'              => now()
                    ]);
                    return $this->successResponse(['message' => __('messages.subItemSuccessfull'), 'deployed' => $deployed], 200);
                } catch (\Throwable $th) {
                    return $this->errorResponse(__('messages.subItemFailed'), 400);
                }
            }else {
                return $this->errorResponse(__('messages.alreadyDone'), 400);
            }
        }else {
            try {
                $contents = $user->subscription->plan->contents;
                $deployed = [];
                foreach ($contents as $key => $content) {
                    switch ($content->type) {
                        case SubscriberPlanContent::FAMEPOINT:
                            $user->addFame($content->amount);
                            $deployed[] = ['name' => 'Fame Point', 'amount' => $content->amount];
                            break;
                        case SubscriberPlanContent::PACK:
                            for($i = 1; ; $i++) {
                                if ($i > $content->amount) {break;}
                                $pack = Pack::where('category_id', $content->pack_type_id)->inRandomOrder()->first();
                                foreach ($pack->contents as $packContent) {
                                    $user->addItem($packContent->item_id, $packContent->amount);
                                    $deployed[] = ['name' => $packContent->item->item_name, 'amount' => $packContent->amount];
                                }
                            }
                            break;
                        case SubscriberPlanContent::COIN:
                            $user->addCredits($content->amount);
                            $deployed[] = ['name' => 'Credits', 'amount' => $content->amount];
                            break;
                        case SubscriberPlanContent::VEHICLE:
                            for($i = 1; ; $i++) {
                                if ($i > $content->amount) {break;}
                                $item = Item::where('category_id', 48)->orWhere('category_id', 49)->orWhere('category_id', 50)->inRandomOrder()->first();
                                $user->addItem($item->id, 1);
                                $deployed[] = ['name' => $item->item_name, 'amount' => 1];
                            }
                            break;
                        case SubscriberPlanContent::ITEM:
                            $user->addItem($content->item_id, $content->amount);
                            $deployed[] = ['name' => $content->item->item_name, 'amount' => $content->amount];
                            break;
                    }
                }
                SubscriptionDeploy::create([
                    'user_id'           => $user->id,
                    'subscription_id'   => $user->subscription->id,
                    'date'              => now()
                ]);
                return $this->successResponse(['message' => __('messages.subItemSuccessfull'), 'deployed' => $deployed], 200);
            } catch (\Throwable $th) {
                return $this->errorResponse(__('messages.subItemFailed'), 400);
            }
        }
    }
}
