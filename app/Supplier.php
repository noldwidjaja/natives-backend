<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use Uuids;

    protected $fillable = [
    	'name',
    	'phone_number',
    	'user_id'	
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
