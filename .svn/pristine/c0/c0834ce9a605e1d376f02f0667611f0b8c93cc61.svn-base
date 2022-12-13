<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class onwerNamesinServerDetails extends Command
{

    protected $signature = 'command:onsd';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = 'yiyYjr7RFM1GfkeYJdwDsCQvlPfj2wUkNhffo2XOgEdDBUUSCUiPFLe78JvVo8sr'; //NOT TO BE CHANGED
        $scriptName = 'ownerNameinServerDetails'; //NOT TO BE CHANGED

        if (!one_time_execution($scriptID)) {
            $query = DB::table('server_details')->where('server_owner', 'spo-increds.')->orWhere('server_owner', 'spo-incredibles')->get();
            // echo count($query);
            if (count($query) > 0) {
                foreach ($query as $qq) {
                    DB::table('server_details')->where('id', $qq->id)->update(['server_owner' => 'Incredibles']);
                }
                DB::table('one_time_executions')->insert(['script_id' => $scriptID, 'script_name' => $scriptName, 'executed' => 'Y', 'created_at' => Carbon::now()]);
            } else {
                echo "Nothing to do";
            }
        }
    }
}
