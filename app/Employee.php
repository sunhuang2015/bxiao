<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    //
    use SoftDeletes;
    /*
     *   $table->integer('company_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->string('number')->unique();
            $table->string('name');
            $table->integer('level_id')->unsigned()->default(1);
            $table->integer('category_id')->unsigned()->default(1);
            $table->integer('status_id')->unsigned()->default(1);
            $table->date('register_date')->default('2010-01-01');
            $table->date('service_date')->default('2099-01-01');
     */
    protected $fillable=[
        'company_id',
        'department_id',
        'level_id',
        'status_id',
        'category_id',
        'number',
        'name',
        'register_date',
        'service_date',
        'remark'
    ];


    public function company(){
        return $this->belongsTo('App\Company');
    }

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }
    public function status(){
        return $this->belongsTo('App\Status');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
