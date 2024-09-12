<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{

    protected $fillable = [
        'status',
        'type',
        'user_id',
        'owner_code',
        'taxid',
        'paymenttype',
        'creditterm',
        'name',
        'address',
        'sub_district',
        'district',
        'province',
        'postal_code',
        'country',
        'description',
        'contractname',
        'imagefile',
        'logofile',
        'phoneno',
        'weburl',
        'facebook',
        'line',
        'location_lat',
        'location_lng',
        'bussinesstype_id',
        'updated_by',
        'bankaccountno',
        'bankaccountname',
        'bank_id',
        'bankbranch',
        'account_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
    public function businesstype()
    {
        return $this->belongsTo('App\Models\Businesstype');
    }
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }
    public function cars()
    {
        return $this->hasMany('App\Models\Car');
    }

    /**
     * Get all of the car_balances for the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function car_balances()
    {
        return $this->hasMany(Car_balance::class);
    }
    /*
	Provide the Location value to the Nova field
	*/
    public function getLocationAttribute()
    {
        return (object) [
            'latitude' => $this->location_lat,
            'longitude' => $this->location_lng,
        ];
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
