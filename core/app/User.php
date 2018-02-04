<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
	
	const DESTINATION_PATH = 'files/users';
	
	const ROLE_USER = '0';
	const ROLE_MERCHANT = '1';
	const ROLE_SUPERADMIN = '2';
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 
		'username', 
		'name', 
		'email', 
		'password', 
		'roles', 
		'address', 
		'phone', 
		'id_category', 
		'id_merchant',
		'image',
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
	 * @param type $query
	 * @return type
	 */
	public function scopeRoleUser($query)
	{
		return $query->where('roles', self::ROLE_USER);
	}
	
	/**
	 * @return type
	 */
	public function merchant()
	{
		return $this->hasOne('App\Merchant', 'id', 'id_merchant');
	}
	
	/**
	 * @return type
	 */
	public function category()
	{
		return $this->hasOne('\App\Category', 'id', 'id_category');
	}
	
    /**
	 * @return array
	 */
    public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'Inactive',
		];
	}
	
	/**
	 * @return string
	 */
	public function getStatusText()
	{
		$list = self::statusLabels();
		
		return $list[$this->status] ? $list[$this->status] : $this->status;
	}
	
	/**
	 * @return boolean
	 */
	public function getIsStatusActive()
	{
		return $this->status == self::STATUS_ACTIVE;
	}
	
	/**
	 * @param type $query
	 * @return query
	 */
	public function scopeActived($query)
	{
		return $query->where('status', self::STATUS_ACTIVE);
	}
	
	/**
	 * @return url
	 */
	public function getImageUrl()
	{
		if ($this->image == null) {
			return null;
		}
		
		return url(self::DESTINATION_PATH . '/' . $this->image);
	}
}
