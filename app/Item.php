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

    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

    public function image()
    {
        return $this->hasMany('App\Image');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }
}
