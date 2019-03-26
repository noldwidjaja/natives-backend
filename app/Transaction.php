<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuids;

    protected $fillable = [
    	'total_price',
    	'status',
        'shipping_address',
    	'customer_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function boughts()
    {
        return $this->hasMany('App\Bought');
    }
}
