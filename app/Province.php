<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'country_id', 'name',
    ];

    public function cities()
    {
        return $this->hasMany('App\City');

    }
    
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

}
