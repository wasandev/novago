<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    protected $table = 'province';

    protected $fillable = [
        'name'
    ];

    public function car()
    {
        return $this->hasMany('App\Models\Car', 'car_province');
    }
    public function district_provinces()
    {
        return $this->hasMany('App\Models\District');
    }
    public function districts()
    {
        return $this->hasMany('App\Models\District', 'name');
    }
    public function branch_area()
    {
        return $this->hasMany('App\Models\Branch_area', 'province', 'name');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address', 'province', 'name');
    }

    public function province_name()
    {
        return $this->hasOne('App\Models\Province', 'province', 'name');
    }

    
    
}
