<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('card_id');
            $table->string('brand');
            $table->string('last4');
            $table->string('exp_month');
            $table->string('exp_year');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
        DB::unprepared('create trigger cards_update before update on cards for each row execute procedure update_date();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER cards_update on cards');
        Schema::dropIfExists('cards');
    }
}
