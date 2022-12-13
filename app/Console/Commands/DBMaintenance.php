<?php

namespace App\Console\Commands;

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

    public function handle()
    {

        $del_servers = DB::table('server_details')->whereNotNull('deleted_at')->get();
        $dd_id_arr = array();

        // echo count($del_servers);
        foreach ($del_servers as $value) {
            $server_id = $value->id;
            $dd_details = DB::table('database_details')->where('server_details_id', $server_id)->whereNull('deleted_at')->get();

            if (count($dd_details) > 0) {
                foreach ($dd_details as $val2) {
                    array_push($dd_id_arr, $val2->id);
                }
            }
            echo $value->server_name . " | " . count($dd_details) . "\n";
        }


        if (count($dd_id_arr) > 0) {

            foreach ($dd_id_arr as $val3) {
                echo ($val3) . " <=== \n";
                $id_det = DB::table('instance_details')->where('database_details_id', $val3)->whereNull('deleted_at')->get();
                if (count($id_det) > 0) {
                    foreach ($id_det as $val4) {
                        // echo $val4->instance_name . " <=== \n";
                        try {
                            DB::table('instance_details')->where('id', $val4->id)->update(['deleted_at' => now()]);
                            DB::table('data_cleanups')->insert(['from_table' => 'instance_details', 'from_table_id' => $val4->id, 'action_performed' => 'added deleted_at time', 'created_at' => now()]);
                            echo " Successful for database_details_id " . $val4->id;
                        } catch (\Throwable $th) {
                            echo "Unable to update record for instance_details_id " . $val4->id . "\n";
                        }
                    }
                }

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
