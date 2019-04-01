<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{ 
	use Notifiable;
	use Uuids;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username', 'email', 'password','role_id',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public $incrementing = false;

	protected $keyType = 'string';


	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	public function getJWTCustomClaims()
	{
		return [];
	}
	public function setPasswordAttribute($password)
	{
		if ( !empty($password) ) {
			$this->attributes['password'] = bcrypt($password);
		}
	}   

	public function sendEmailVerificationNotification()
	{
		$this->notify(new \App\Notifications\EmailVerification);
	}

	public function role()
	{
	  return $this->belongsTo('App\Role');
	}

	public function customer_profile()
	{
		return $this->hasOne('App\Customer');
	}

	public function supplier_profile()
	{
		return $this->hasOne('App\Supplier');
	}

	public function authorizeRoles($roles)
	{
	  if ($this->hasAnyRole($roles)) {
		return true;
	  }
	  abort(401, 'This action is unauthorized.');
	}

	public function hasAnyRole($roles)
	{
  		if (is_array($roles)) {
			foreach ($roles as $role) {
		  		if ($this->hasRole($role)) {
					return true;
				}
			}
		} else {
			if ($this->hasRole($roles)) {
				return true;
			}
	  	}
		return false;
	}
	
	public function hasRole($role)
	{
	  if ($this->role()->where('name', $role)->first()) {
		return true;
	  }
	  return false;
	}

	public function isCustomer()
	{
		if ($this->customer_profile()->first()) {
		return true;
	  }
	  return false;
	}

	public function isSupplier()
	{
		if ($this->supplier_profile()->first()) {
		return true;
	  }
	  return false;
	}
}
