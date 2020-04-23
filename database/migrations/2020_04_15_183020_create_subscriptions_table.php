<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('user_id');
            $table->string('subscription_id');
            $table->dateTimeTz('start_date');
            $table->dateTimeTz('current_period_start');
            $table->dateTimeTz('current_period_end');
            $table->boolean('cancelled')->default(False);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('plan_id')->references('id')->on('subscriber_plans');
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::unprepared('create trigger subscriptions_update before update on subscriptions for each row execute procedure update_date();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER subscriptions_update on subscriptions');
        Schema::dropIfExists('subscriptions');
    }
}
