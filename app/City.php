<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'province_id', 'name',
    ];

    public function churches()
    {
        return $this->hasMany('App\Church');
    }

    public function province()
    {
        return $this->belongsTo('App\Province');
    }
}
