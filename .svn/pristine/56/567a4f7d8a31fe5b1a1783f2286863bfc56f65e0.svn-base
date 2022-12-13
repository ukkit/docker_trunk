<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenkinsJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenkins_jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('instance_details_id');
            $table->unsignedBigInteger('action_histories_id');
            $table->unsignedInteger('jenkins_credentials_id');
            $table->unsignedInteger('users_id');
            $table->string('last_job_url')->nullable();
            $table->integer('last_job_id')->nullable();
            $table->string('current_job_url')->nullable();
            $table->integer('current_job_id');
            $table->string('action');
            $table->string('status');
            $table->integer('estimated_time')->nullable();
            $table->integer('actual_time')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instance_details_id')->references('id')->on('instance_details');
            $table->foreign('action_histories_id')->references('id')->on('action_histories');
            $table->foreign('jenkins_credentials_id')->references('id')->on('jenkins_credentials');
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
        Schema::dropIfExists('jenkins_jobs');
    }
}
