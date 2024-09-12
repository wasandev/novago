<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Unit extends Model
{


    protected $fillable = [
        'name', 'user_id', 'updated_by'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }
}
