<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use Uuids;

    protected $fillable = [
    	'name'
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    public function users()
    {
      return $this->belongsToMany(User::class);
    }
}
