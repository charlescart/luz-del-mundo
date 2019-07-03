<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    protected $fillable = [
        'city_id', 'name', 'number_church', 'shepherd', 'phone_contact', 'address',
        'custom_name_at', 'church_verified_at'
    ];

    protected $dates = ['church_verified_at', 'custom_name_at'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
