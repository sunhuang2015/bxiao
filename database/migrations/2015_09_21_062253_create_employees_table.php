<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('number')->unique();
            $table->string('name');
            $table->integer('level_id')->unsigned()->default(1);
            $table->integer('category_id')->unsigned()->default(1);
            $table->integer('status_id')->unsigned()->default(1);
            $table->date('register_date')->default('2010-01-01');
            $table->date('service_date')->default('2099-01-01');
            $table->softDeletes();
            $table->text('remark')->nullable();
            $table->string('email')->nullable();

            $table->timestamps();


            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('employees');
    }
}
