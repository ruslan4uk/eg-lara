<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nallable();
            $table->string('name')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('tour_route')->nullable();
            $table->integer('category_id')->nullable();         // HasMany
            $table->integer('people_category_id')->nullable();  // HasMany
            $table->integer('people_count')->nullable();
            $table->integer('timing_id')->nullable();           // HasMany
            $table->string('price')->nullable();
            $table->integer('currency_id')->nullable();
            $table->integer('price_type_id')->nullable();       // HasMany
            $table->string('tour_services')->nullable();
            $table->string('tour_more')->nullable();
            $table->string('tour_other')->nullable();
            $table->text('about')->nullable();
            $table->integer('active')->nullable();
            $table->integer('status')->nullable();
            $table->json('properties')->nullable();
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
        Schema::dropIfExists('tours');
    }
}
