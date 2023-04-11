<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('f_name');
            $table->string('l_name');
            $table->string('phone')->unique();
            $table->string('email')->unique();
            $table->integer('role');
            $table->string('password');
            $table->boolean('active')->default(0);
            $table->bigInteger('code_active')->nullable();
            $table->timestamps();
        });
        User::firstOrCreate([
            'f_name'=>'rida',
            'l_name'=>'madi',
            'phone'=>'937616791',
            'role'=>'3',
            'email'=>'rida.ali.madi@gmail.com',
            'password'=>Hash::make("12345678"),
            'active' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
