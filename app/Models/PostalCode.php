<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PostalCode extends Model
{

    protected $table = 'postal_code';

    protected $fillable = [
        'code',
        'sub_district_id',
        'district_id',
        'province_id'
    ];

    public function sub_district()
    {
        return $this->belongsTo('App\Models\SubDistrict');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }
}
