<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTourLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tour_language', function (Blueprint $table) {
            // foreign tour_id
            $table->bigInteger('tour_id')->unsigned()->index()->change();
            $table->foreign('tour_id')
                    ->references('id')->on('tours')
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
        Schema::table('tour_language', function (Blueprint $table) {
            $table->dropForeign(['tour_id']);
            $table->dropForeign(['language_id']);
        });
    }
}
