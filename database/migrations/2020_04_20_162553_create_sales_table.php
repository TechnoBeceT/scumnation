<?php

use App\Models\Trading\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('pack_id')->nullable();
            $table->decimal('price',9,2);
            $table->string('content_type')->default(Sale::ITEM);
            $table->integer('daily_limit')->default(0);
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('pack_id')->references('id')->on('packs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
