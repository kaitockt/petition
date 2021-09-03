<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToPetitionUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('petition_users', function (Blueprint $table) {
            //
            $table->foreign('petitionID')->references('id')->on('petition');
            $table->foreign('userID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('petition_users', function (Blueprint $table) {
            //
            $table->dropForeign(['petitionID', 'userID']);
        });
    }
}
