<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use Uuids;

    protected $fillable = [
    	'name',
    	'directory',
        'item_id',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function item()
    {
    	return $this->belongsTo('App\Item');
    }
}
