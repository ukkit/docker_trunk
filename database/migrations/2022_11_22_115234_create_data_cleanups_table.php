<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataCleanupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cleanups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('from_table');
            $table->unsignedInteger('from_table_id');
            $table->string('action_performed');
            $table->unsignedInteger('users_id')->nullable();
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
        Schema::dropIfExists('data_cleanups');
    }
}
