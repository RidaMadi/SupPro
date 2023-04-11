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
        Schema::create('factories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('id_city')->index();
            $table->bigInteger('id_region')->index();
            $table->string('name')->unique();
            $table->double('cost')->default(0);
            $table->string('logo');
            $table->text('address');
            $table->string('location_x');
            $table->string('location_y');
            $table->boolean('active')->default(1);
            $table->boolean('delete')->default(0);
            $table->double('ad_price');
            $table->double('profit_ratio');
            $table->double('proCoin')->nullable();
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
        Schema::dropIfExists('factories');
    }
};
