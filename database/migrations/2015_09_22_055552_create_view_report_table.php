<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        $create_view="create view report_views as  SELECT
            reports.id,
            employees.number as 工号,
            employees.`name` as  姓名,
            companies.`name` as 公司,
            departments.`name` as 部门,
            departments.costcenter as 成本中心,
            reports.months as 月,
            reports.fee as 费用,
            employees.bank_account as 账号,
            levels.credit as 限额

            FROM
            employees ,
            reports ,
            companies ,
            departments ,
            levels
            WHERE
            employees.id = reports.employee_id AND
            employees.company_id = companies.id AND
            employees.department_id = departments.id AND
            levels.id = employees.level_id";
        \DB::statement($create_view);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        \DB::statement('drop view report_views');
    }
}
