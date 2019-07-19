<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_contacts', function (Blueprint $table) {
            // foreign user_id
            $table->bigInteger('user_id')->unsigned()->index()->change();
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');

            // foreign type
            $table->bigInteger('type')->unsigned()->index()->change();
            $table->foreign('type')
                    ->references('id')->on('contact_type')
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
        Schema::table('user_contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['type']);
        });
    }
}
