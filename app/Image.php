<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Uuids;

    protected $fillable = [
    	'name',
    	'directory'
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
