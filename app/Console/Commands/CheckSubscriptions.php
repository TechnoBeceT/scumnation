<?php

namespace App\Console\Commands;

use App\Http\Controllers\Finance\StripeController;
use App\Models\Finance\Subscriptions;
use App\Models\Users\User;
use Illuminate\Console\Command;
use Carbon\Carbon;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkSubscriptions';

     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily check subscriptions.';

    protected $chunkSize = 100;

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StripeController $stripeController)
    {
        parent::__construct();
        $this->stripeController = $stripeController;
    }

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
            $subscriptionInfo = $this->stripeController->getSubscription($user, $subscription);
            if(isset($subscriptionInfo['canceled_at'])) {
                $subscription->cancelled = True;
                $subscription->save();
            }
            if($subscriptionInfo['status'] == 'active') {
                $subscription->current_period_start = Carbon::createFromTimestamp($subscriptionInfo['current_period_start']);
                $subscription->current_period_end = Carbon::createFromTimestamp($subscriptionInfo['current_period_end']);
                $subscription->save();
            }else {
                $subscription->delete();
            }
        }
    }
}
