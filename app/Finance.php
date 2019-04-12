<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finance extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'finance_classification_id', 'currency_id', 'amount', 'debt', 'description', 'tithe',
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function finance_classification()
    {
        return $this->belongsTo('App\FinanceClassification');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }
}
