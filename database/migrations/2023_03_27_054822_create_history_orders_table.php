<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('factory_id')->index();
            $table->bigInteger('market_id')->index();
            $table->bigInteger('driver_id')->index()->nullable();
            $table->string('accept');
            $table->double('total_price')->nullable();
            $table->date('time_for_delivery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_orders');
    }
};
