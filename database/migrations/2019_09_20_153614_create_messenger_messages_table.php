<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengerMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messenger_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dialog_uid');

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users');

            $table->bigInteger('user_to_id')->unsigned();
            $table->foreign('user_to_id')
                ->references('id')->on('users');

            $table->boolean('is_read')->default(false);
            $table->boolean('is_visible_user')->default(true);
            $table->boolean('is_visible_user_to')->default(true);
            $table->text('message');
            $table->json('attach')->nullable();

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
        Schema::dropIfExists('messenger_messages');
    }
}
