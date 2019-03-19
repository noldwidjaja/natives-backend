<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Uuids;

    protected $fillable = [
    	'name'
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
