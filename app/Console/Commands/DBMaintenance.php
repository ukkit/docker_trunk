<?php

namespace App\Console\Commands;

use App\Models\Ml_detail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class DBMaintenance extends Command
{

    protected $signature = 'command:DBM';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    private function update_deleted_at($tablename, $id)
    {
        try {
            DB::table($tablename)->where('id', $id)->update(['deleted_at' => now()]);
            DB::table('data_cleanups')->insert(['from_table' => $tablename, 'from_table_id' => $id, 'action_performed' => 'added deleted_at time', 'created_at' => now()]);
            return True;
        } catch (\Throwable $th) {
            return ($th);
        }
    }

    private function update_intellicus($id)
    {
        try {
            DB::table('intellicus_details')->where('id', $id)->update(['is_active' => 'N']);
            DB::table('data_cleanups')->insert(['from_table' => 'intellicus_details', 'from_table_id' => $id, 'action_performed' => 'marked is_active to N', 'created_at' => now()]);
            return True;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    private function update_instance($id)
    {
        try {
            DB::table('instance_details')->where('id', $id)->update(['instance_is_active' => 'N']);
            DB::table('data_cleanups')->insert(['from_table' => 'instance_details', 'from_table_id' => $id, 'action_performed' => 'marked instance_is_active to N', 'created_at' => now()]);
            return True;
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function handle()
    {

        // Getting list of all servers deleted
        try {
            $deleted_servers = DB::table('server_details')->whereNotNull('deleted_at')->get();
            $dsc = count($deleted_servers);
        } catch (\Throwable $th) {
            $dsc = 0;
            $deleted_servers = null;
        }

        // Do operation only if count of deleted_Server is more than 0 (zero)
        if ($dsc > 0) {

            foreach ($deleted_servers as $dscval) {
                $server_id = $dscval->id;

                // Geting count from database_Details
                $database_details = DB::table('database_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
                $dd_count = count($database_details);
                $dba_details = DB::table('dba_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
                $dbad_count = count($dba_details);
                $ml_details = DB::table('ml_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
                $mld_count = count($ml_details);
                $intellicus_details = DB::table('intellicus_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
                $itd_count = count($intellicus_details);
                $instance_details = DB::table('instance_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
                $insd_count = count($instance_details);
            }
        }

        $dd_id_arr = array();
        $dba_id_arr = array();
        $ml_id_arr = array();

        // echo count($del_servers);
        foreach ($deleted_servers as $value) {
            $server_id = $value->id;

            $dd_details = DB::table('database_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
            $dba_details = DB::table('dba_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
            $ml_details = DB::table('ml_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();

            $intellicus_details = DB::table('intellicus_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();
            $instance_details = DB::table('instance_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();

            if (count($dd_details) > 0) {
                foreach ($dd_details as $val2) {
                    $rv = $this->update_deleted_at('database_details', $val2->id);
                    if ($rv) {
                        array_push($dd_id_arr, $val2->id);
                    } else {
                        echo "Error occured for database_details " . $rv;
                    }
                }
            }

            if (count($dba_details) > 0) {
                foreach ($dba_details as $dbad) {
                    $rv = $this->update_deleted_at('dba_details', $dbad->id);
                    if ($rv) {
                        array_push($dba_id_arr, $dbad->id);
                    } else {
                        echo "Error occured for database_details " . $rv;
                    }
                }
            }

            if (count($ml_details) > 0) {
                foreach ($ml_details as $mld) {
                    $rv = $this->update_deleted_at('ml_details', $mld->id);
                    if ($rv) {
                        array_push($ml_id_arr, $mld->id);
                    } else {
                        echo "Error occured for database_details " . $rv;
                    }
                }
            }

            if (count($intellicus_details) > 0) {
                foreach ($intellicus_details as $intd) {
                    $rv = $this->update_intellicus($intd->id);
                    if ($rv) {
                        array_push($ml_id_arr, $intd->id);
                    } else {
                        echo "Error occured for database_details " . $rv;
                    }
                }
            }

            if (count($instance_details) > 0) {
                foreach ($intellicus_details as $insd) {
                    $rv = $this->update_instance($insd->id);
                    if ($rv) {
                        array_push($ml_id_arr, $insd->id);
                    } else {
                        echo "Error occured for database_details " . $rv;
                    }
                }
            }

            // echo $value->server_name . " | " . count($dd_details) . "\n";
        }

        // dd($dd_id_arr);

        if (count($dd_id_arr) > 0) {
            foreach ($dd_id_arr as $val3) {
                // echo ($val3) . " <=== \n";
                // INSTANCE DETAILS TABLE CLEANUP
                $id_det = DB::table('instance_details')->where('database_details_id', $val3)->whereNull('deleted_at')->get();
                if (count($id_det) > 0) {
                    foreach ($id_det as $val4) {
                        try {
                            DB::table('instance_details')->where('id', $val4->id)->update(['deleted_at' => now()]);
                            DB::table('data_cleanups')->insert(['from_table' => 'instance_details', 'from_table_id' => $val4->id, 'action_performed' => 'added deleted_at time', 'created_at' => now()]);
                            echo " Successful for database_details_id " . $val4->id;
                        } catch (\Throwable $th) {
                            echo "Unable to update record for instance_details_id " . $val4->id . "\n";
                        }
                    }
                }

                // DBA DETAILS TABLE CLEANUP
                // $dba_details = DB::table('dba_details')->where('');
                // DATABASE DETAILS TABLE CLEANUP
                try {
                    DB::table('database_details')->where('id', $val3)->update(['deleted_at' => now()]);
                    DB::table('data_cleanups')->insert(['from_table' => 'database_details_id', 'from_table_id' => $val3, 'action_performed' => 'added deleted_at time', 'created_at' => now()]);
                    echo " Successful for database_details_id " . $val3;
                } catch (\Throwable $th) {
                    echo "Unable to update record for database_details_id " . $th . " \n";
                }
            }
        }
        echo count($dd_id_arr);
    }
}
