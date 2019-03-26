<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role_User extends Model
{
    use Uuids;

    protected $fillable = [
    	'role_id',
    	'user_id'
    ];

    public $incrementing = false;

    protected $keyType = 'string';
}
