<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{

    protected $fillable = [
        'company_name',
        'taxid',
        'address',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'country',
        'description',
        'imagefile',
        'email',
        'logofile',
        'phoneno',
        'weburl',
        'facebook',
        'line',
        'location_lat',
        'location_lng',
        'user_id',
        'updated_by',
        'orderprint_option'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function province_name() {
        return $this->belongsTo('App\Models\Province','province','name');
    }

    public function district_name() {
        return $this->belongsTo('App\Models\District','district','name');
    }

    public function subdistrict_name() {
        return $this->belongsTo('App\Models\SubDistrict','sub_district','name');
    }
    
}
