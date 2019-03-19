<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use Uuids;

    protected $fillable = [
    	'name',
    	'price',
    	'stock',
    	'description',
    	'gender_id',
    	'type_id',
    	'supplier_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
