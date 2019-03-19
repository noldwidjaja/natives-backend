<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use Uuids;

    protected $fillable = [
    	'customer_id',
        'item_id',
    	'item_quantity',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }
}
