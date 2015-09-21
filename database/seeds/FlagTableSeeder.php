<?php

use Illuminate\Database\Seeder;

class FlagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('flags')->delete();
        \DB::table('flags')->insert([
            ['name'=>'未接收','code'=>1],
            ['name'=>'出报表','code'=>2],
            ['name'=>'总经理批准','code'=>3],
            ['name'=>'财务审批','code'=>4],
            ['name'=>'GBS','code'=>5],
        ]);
    }
}
