<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use Uuids;

    protected $fillable = [
 		'payment_method',
 		'total_price',
 		'payment_date',
 		'transaction_id'   	
    ];

    public $incrementing = false;

    protected $keyType = 'string';

	public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}


