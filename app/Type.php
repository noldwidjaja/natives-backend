<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use Uuids;

    protected $fillable = [
    	'name',
    	'category_id'	
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
