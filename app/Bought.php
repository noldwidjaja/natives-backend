<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bought extends Model
{
    use Uuids;

    protected $fillable = [
    	'transaction_id',
    	'item_id',
    	'amount',
    ];

    public function transaction()
    {
    	return $this->belongsTo('App\Transaction');
    }
}
