<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    //
    use SoftDeletes;
    protected $fillable=['company_id','name','costcenter'];

    public function company(){
        return $this->belongsTo('App\Company');
    }

    protected $appends = ['full_name'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function getFullNameAttribute()
    {
        return $this->attributes['name'].
        '_' . $this->attributes['costcenter'];
    }

    public static $rule=[
      "company_id"=>'exists:companies,id',
        'name'=>'unique_with:departments,company'
    ];
}
