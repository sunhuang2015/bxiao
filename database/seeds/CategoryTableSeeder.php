<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('categories')->delete();
        \DB::table('categories')->insert([
            ['name'=>'报销（含托收)人员','code'=>1],
            ['name'=>'托收人员','code'=>1],

        ]);
    }
}
