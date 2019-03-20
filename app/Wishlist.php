<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use Uuids;

    protected $fillable = [
    	'customer_id',
        'item_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }   
}
