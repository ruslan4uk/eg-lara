<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengerDialogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_dialog', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uid')->unique();

            $table->bigInteger('user_one')->unsigned();
            $table->foreign('user_one')
                ->references('id')->on('users');

            $table->bigInteger('user_two')->unsigned();
            $table->foreign('user_two')
                ->references('id')->on('users');

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
        Schema::dropIfExists('messenger_dialog');
    }
}
