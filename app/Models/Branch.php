<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{

    protected $fillable = [
        'code',
        'name',
        'address',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'country',
        'phoneno',
        'type',
        'partner_rate',
        'dropship_rate',
        'dropship_flag',
        'vendor_id',
        'location_lat',
        'location_lng',
        'user_id',
        'updated_by'
    ];

    public function branch_areas()
    {
        return $this->hasMany('App\Models\Branch_area');
    }

    public function branch_routes()
    {
        return $this->hasMany('App\Models\Branch_route');
    }


    public function getLocationAttribute()
    {
        return (object) [
            'latitude' => $this->location_lat,
            'longitude' => $this->location_lng,
        ];
    }
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    public function serviceprice_items()
    {
        return $this->hasMany('App\Models\Serviceprice_item', 'from_branch_id', 'id');
    }


    public function routeto()
    {
        return $this->belongsToMany('App\Models\Branch', 'routeto_branch', 'branch_id', 'dest_branch_id')
            ->withPivot('name', 'distance')
            ->withTimestamps();
    }


    public function branch_balances()
    {
        return $this->hasMany('App\Models\Branch_balance', 'branch_id');
    }

    /*
	Transform the returned value from the Nova field
	*/
    public function setLocationAttribute($value)
    {
        $location_lat = round(object_get($value, 'latitude'), 7);
        $location_lng = round(object_get($value, 'longitude'), 7);
        $this->attributes['location_lat'] = $location_lat;
        $this->attributes['location_lng'] = $location_lng;
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
