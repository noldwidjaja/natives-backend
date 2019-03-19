<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use Uuids;

    protected $fillable = [
    	'customer_id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
