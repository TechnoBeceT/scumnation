<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('killer_id');
            $table->string('killerX');
            $table->string('killerY');
            $table->string('killerZ');
            $table->unsignedBigInteger('victim_id');
            $table->string('victimX');
            $table->string('victimY');
            $table->string('victimZ');
            $table->string('type');
            $table->timestamp('date');
            $table->foreign('killer_id')->references('id')->on('users');
            $table->foreign('victim_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kills');
    }
}
