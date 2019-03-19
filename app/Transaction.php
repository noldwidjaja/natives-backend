<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuids;

    protected $fillable = [
    	'total_price',
    	'status',
    	'customer_id',
        'supplier_id',
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

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
