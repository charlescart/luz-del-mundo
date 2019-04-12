<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'description'];

    protected $dates = ['deleted_at'];

    public function finances()
    {
        return $this->hasMany('App\Finance');
    }
}
