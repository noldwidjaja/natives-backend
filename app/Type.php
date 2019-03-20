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

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }
}
