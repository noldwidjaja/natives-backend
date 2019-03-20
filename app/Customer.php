<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use Uuids;

    protected $fillable = [
    	'first_name',
    	'last_name',
    	'gender_id',
    	'date_of_birth',
    	'phone_number',
    	'user_id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function cart()
    {
        return $this->hasOne('App\Cart');
    }

    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
