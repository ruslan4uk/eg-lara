<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_service', function (Blueprint $table) {
            // foreign user_id
            $table->bigInteger('user_id')->unsigned()->index()->change();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            // foreign service_id
            $table->bigInteger('service_id')->unsigned()->index()->change();
            $table->foreign('service_id')
                    ->references('id')->on('services')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_service', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['service_id']);
        });
    }
}
