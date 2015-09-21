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
}
