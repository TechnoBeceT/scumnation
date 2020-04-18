<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriberPlanContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriber_plan_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->string('type');
            $table->integer('amount');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('pack_type_id')->nullable();
            $table->integer('days');
            $table->foreign('plan_id')->references('id')->on('subscriber_plans');
            $table->foreign('pack_type_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriber_plan_contents');
    }
}
