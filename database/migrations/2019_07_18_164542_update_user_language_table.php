<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_language', function (Blueprint $table) {
            // foreign user_id
            $table->bigInteger('user_id')->unsigned()->index()->change();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            // foreign language_id
            $table->bigInteger('language_id')->unsigned()->index()->change();
            $table->foreign('language_id')
                    ->references('id')->on('languages')
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
        Schema::table('user_language', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['language_id']);
        });
    }
}
