<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdFieldToDetailsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->after('old_pai_details_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::table('server_details', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->after('server_uses_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::table('database_details', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->after('ambari_details_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->after('database_details_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::table('ml_details', function (Blueprint $table) {
            $table->unsignedInteger('users_id')->after('database_details_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });

        Schema::table('server_details', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });

        Schema::table('database_details', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });

        Schema::table('instellicus_details', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });

        Schema::table('ml_details', function (Blueprint $table) {
            $table->dropColumn('users_id');
        });
    }
}
