<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJenkinsCredIdInInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->unsignedInteger('jenkins_credentials_id')->after('ml_details_id')->nullable();

            $table->string('jenkins_uname')->after('jenkins_url')->nullable()->comment('To be removed in future revisions 08/31/2022')->change();
            $table->string('jenkins_pwd')->after('jenkins_uname')->nullable()->comment('To be removed in future revisions 08/31/2022')->change();
            $table->string('jenkins_token')->after('jenkins_pwd')->nullable()->comment('To be removed in future revisions 08/31/2022')->change();

            $table->foreign('jenkins_credentials_id')->references('id')->on('jenkins_credentials');
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
            $table->dropColumn('jenkins_credentials_id');

            $table->string('jenkins_uname')->after('jenkins_url')->nullable()->change();
            $table->string('jenkins_pwd')->after('jenkins_uname')->nullable()->change();
            $table->string('jenkins_token')->after('jenkins_pwd')->nullable()->change();
        });
    }
}
