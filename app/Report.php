<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //

    protected $fillable=[
        'employee_id',
        'months',
        'months_string',
        'fee',
        'flag_id'];


    public function employee(){
        return $this->belongsTo('App\Employee');
    }

    public function flag(){
        return $this->belongsTo('App\Flag');
    }
}
