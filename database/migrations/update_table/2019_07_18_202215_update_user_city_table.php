<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_city', function (Blueprint $table) {
            // foreign user_id
            $table->bigInteger('user_id')->unsigned()->index()->change();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            // foreign city_id
            // $table->bigInteger('city_id')->unsigned()->index()->change();
            // $table->foreign('city_id')
            //         ->references('id')->on('city')
            //         ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_city', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            // $table->dropForeign(['city_id']);
        });
    }
}
