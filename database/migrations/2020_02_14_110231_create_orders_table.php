<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            // user
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            // tour
            $table->unsignedBigInteger('tour_id');
            $table->foreign('tour_id')
                ->references('id')->on('tours')
                ->onDelete('cascade');

            // guide
            $table->unsignedBigInteger('guide_id');
            $table->foreign('guide_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->integer('date_type')->nullable();
            $table->timestamp('date_start');
            $table->timestamp('date_end')->nullable();
            $table->integer('people_count');
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('messenger')->nullable();
            $table->text('comment')->nullable();
            $table->string('hash')->nullable();
            $table->timestamp('confirmation')->nullable();
            $table->integer('status')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
