<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinanceClassification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'color', 'class', 'fund',
    ];

    protected $dates = ['deleted_at'];

    public function finances()
    {
        return $this->hasMany('App\Finance');
    }
}
