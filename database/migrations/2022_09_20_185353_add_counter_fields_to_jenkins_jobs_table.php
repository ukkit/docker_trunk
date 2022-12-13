<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCounterFieldsToJenkinsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenkins_jobs', function (Blueprint $table) {

            $table->integer('check_counter')->after('actual_time')->nullable()->default(0);
            $table->integer('error_counter')->after('check_counter')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenkin_jobs', function (Blueprint $table) {
            $table->dropColumn('check_counter');
            $table->dropColumn('error_counter');
        });
    }
}
