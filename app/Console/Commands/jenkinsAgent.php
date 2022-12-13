<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Log;

class jenkinsAgent extends Command
{

    // STEPS:
    // 1. read records from jenkins_jobs table where status is STARTED
    // 2. For each record with above status, get status from jenkins page
    // 3. If status of jenkins job is still running, then don't do anything
    // 4. If status of jenkis job is complete, then update record in jenkins_job, instance_details and action_histories tables

    protected $signature = 'command:jenAgent';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $jenJobs = DB::table('jenkins_jobs')->where('status', 'STARTED')->whereNull('deleted_at')->get();

        foreach ($jenJobs as $job) {
            $ah_status = null;
            $jenC = DB::table('jenkins_credentials')->where('id', $job->jenkins_credentials_id)->first();
            $jUser = $jenC->jenkins_user;
            $jtoken = \Crypt::decrypt($jenC->jenkins_token);
            $counter = 0;

            try {
                // echo 'curl --silent -u' . $jUser . ':' . $jtoken . ' ' . $job->current_job_url . '/api/xml';
                $preJ = exec('curl --silent -u' . $jUser . ':' . $jtoken . ' ' . $job->current_job_url . '/api/xml');
            } catch (\Throwable $th) {
                log::error('Error in curl jenAgent: ' . $th);
                $preJ = null;
            }

            if ($preJ) {
                try {
                    $preJ_xml = simplexml_load_string($preJ);
                } catch (\Throwable $th) {
                    log::error('Error in simplexml_load_string: ' . $th);
                    $preJ_xml = null;
                }

                if ($preJ_xml) {
                    if (trim($preJ_xml->building) == "true") {
                        // $build_out = $preJ_xml->result;
                        log::debug("[jenAgent] Build in progress for Instance ID " . $job->instance_details_id);
                        echo "Build in progress for Instance ID " . $job->instance_details_id . "\n";
                        $counter = $job->check_counter + 1;
                        DB::table('jenkins_jobs')->where('id', $job->id)->update(['check_counter' => $counter, 'updated_at' => now()]);
                    } else {
                        if ($preJ_xml->result == 'SUCCESS') {
                            $ah_status = 'Successful';
                        } elseif ($preJ_xml->result == 'FAILURE') {
                            $ah_status = 'Failed';
                        } else {
                            $ah_status = $preJ_xml->result;
                        }
                        $actual_time = $preJ_xml->duration;

                        DB::table('jenkins_jobs')->where('id', $job->id)->update(['status' => $preJ_xml->result, 'actual_time' => $actual_time, 'updated_at' => now()]);
                        if (env('JENAGENT_DB_CHANGES') == 'True') {
                            if (strpos($job->action, 'upgrade')) {
                                $get_ah = DB::table('action_histories')->where('id', $job->action_histories_id)->first();
                                // dd($get_ah);
                                if ($get_ah->new_build_id) {
                                    $spm = DB::table('product_versions')->select('pv_id')->where('id', $get_ah->new_build_id)->first();
                                    $spm_pvid = $spm->pv_id;
                                } else {
                                    $spm_pvid = null;
                                }
                                if ($get_ah->new_pai_build_id) {
                                    $pai = DB::table('pai_builds')->select('pv_id')->where('id', $get_ah->new_pai_build_id)->first();
                                    $pai_pvid = $pai->pv_id;
                                } else {
                                    $pai_pvid = null;
                                }
                                if ($get_ah->new_sf_build_id) {
                                    $sf = DB::table('sf_versions')->select('pv_id')->where('id', $get_ah->new_sf_build_id)->first();
                                    $sf_pvid = $sf->pv_id;
                                } else {
                                    $sf_pvid = null;
                                }
                                if ((!empty($spm_pvid)) || (!empty($pai_pvid)) || (!empty($sf_pvid))) {
                                    try {
                                        DB::table('instance_details')->where('id', $job->instance_details_id)->update(['pv_id' => $spm_pvid, 'pai_pv_id' => $pai_pvid, 'sf_pv_id' => $sf_pvid]);
                                    } catch (\Throwable $th) {
                                        //throw $th;
                                        log::critical("[jenAgent] unable to update pv_id, pai_pv_id and sf_pv_id in instance_details table " . $th);
                                    }
                                }
                            }
                            DB::table('instance_details')->where('id', $job->instance_details_id)->update(['running_jenkins_job' => 'N', 'instance_is_active' => 'Y']);
                            DB::table('action_histories')->where('id', $job->action_histories_id)->update(['status' => $ah_status, 'end_time' => now(), 'updated_at' => now()]);
                        } else {
                            log::debug("[jenAgent] not updating instance_details & action_histories tables as env variable JENAGENT_DB_CHANGES is not set");
                        }
                    }
                } else {

                    if ($job->error_counter < 6) { //WAIT FOR 30 MINUTES BEFORE MARKING IT AS ERROR
                        $counter = $job->error_counter + 1;
                        DB::table('jenkins_jobs')->where('id', $job->id)->update(['error_counter' => $counter, 'updated_at' => now()]);
                    } else {
                        DB::table('jenkins_jobs')->where('id', $job->id)->update(['status' => 'ERROR', 'updated_at' => now()]);
                    }
                }
            }
        }
    }
}
