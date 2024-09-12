<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class SubDistrict extends Model
{


    protected $table = 'sub_district';

    protected $fillable = [
        'name', 'district_id'
    ];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
    
    public function subdistrict_name()
    {
        return $this->hasOne('App\Models\SubDistrict', 'sub_district', 'name');
    }
}
