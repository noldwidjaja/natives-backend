<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use Uuids;

    protected $fillable = [
    	'total_price',
    	'status',
    	'customer_id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
