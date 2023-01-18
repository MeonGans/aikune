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
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id')->nullable();
            $table->integer('aim')->nullable();
            $table->string('name')->nullable();
            $table->string('sex')->nullable();
            $table->integer('body_type')->nullable();
            $table->integer('s5_back')->nullable();
            $table->integer('s6_activity')->nullable();
            $table->integer('s7_day')->nullable();
            $table->integer('s8_attention')->nullable();
            $table->integer('s9_training')->nullable();
            $table->integer('s10')->nullable();
            $table->integer('s11_backache')->nullable();
            $table->integer('s12')->nullable();
            $table->integer('s13_usually')->nullable();
            $table->integer('s14_legs')->nullable();
            $table->integer('s15_diseases')->nullable();
            $table->integer('s16')->nullable();
            $table->integer('s17_sit')->nullable();
            $table->integer('s18_position')->nullable();
            $table->integer('s19_see')->nullable();
            $table->integer('s20_sleep')->nullable();
            $table->integer('s21_exercises')->nullable();
            $table->integer('age')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
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
        Schema::dropIfExists('surveys');
    }
};
