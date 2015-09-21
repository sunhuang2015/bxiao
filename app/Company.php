<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    //
    protected $fillable=['name'];
    use SoftDeletes;

    public function department(){
        return $this->hasMany('App\Department');
    }
}
