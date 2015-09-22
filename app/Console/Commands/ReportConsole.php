<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Employee;
use App\Report;
use Illuminate\Validation\Validator;
class ReportConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:fee';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $employees=Employee::all();
        $rules=[
          'employee_id'=>'unique_with:reports,months'
        ];
        foreach($employees as $employees){
           // $report=new Report();
            $report['employee_id']=$employees->id;
           // $report['months']='2015-08-01';
            $report['months']=Carbon::now()->firstOfMonth();
            $report['months_string']=$report['months'];
            $report['fee']=0;
            $report['flag_id']=1;
            $v=\Validator::make($report,$rules);
            if($v->fails()){

            }else{
                $r=Report::create($report);
            }
    }

    }
}
