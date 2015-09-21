<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('levels')->delete();
        \DB::table('levels')->insert([
            ['name'=>'1000元','code'=>1,'credit'=>1000],
            ['name'=>'400元','code'=>2,'credit'=>400],
            ['name'=>'88元','code'=>3,'credit'=>88],
            ['name'=>'实报实销','code'=>4,'credit'=>2000],
        ]);
    }
}
