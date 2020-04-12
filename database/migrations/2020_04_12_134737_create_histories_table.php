<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('killer_id')->nullable();
            $table->unsignedBigInteger('victim_id')->nullable();
            $table->string('type');
            $table->string('action_type');
            $table->decimal('amount',9,2);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('killer_id')->references('id')->on('users');
            $table->foreign('victim_id')->references('id')->on('users');
        });
        DB::unprepared('create trigger histories_update before update on histories for each row execute procedure update_date();');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER histories_update on histories');
        Schema::dropIfExists('histories');
    }
}
