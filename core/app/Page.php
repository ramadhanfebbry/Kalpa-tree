<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	const TYPE_COFFEE = 'coffee';
	const TYPE_RESTAURANT = 'restaurant';
	const TYPE_BAR_LOUNGE = 'bar_lounge';
	
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'title', 'slug', 'description', 'image', 'status', 'order_no'];
	
	public static function typeLabels()
	{
		return [
			self::TYPE_COFFEE => 'Coffee',
			self::TYPE_RESTAURANT => 'Restaurant',
			self::TYPE_BAR_LOUNGE => 'Bar & Lounge',
		];
	}
	
	public function getTypeLabel() {
		$list = self::typeLabels();
		return isset($list[$this->type]) ? $list[$this->type] : '';
	}
	
	public function scopeActived($scope) {
		return $scope->where($this->table . '.status', '=', self::STATUS_ACTIVE);
	}
	
	public static function statusLabels()
	{
		return [
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'Inactive',
		];
	}
	
	public function getStatusLabel() {
		$list = self::statusLabels();
		return isset($list[$this->status]) ? $list[$this->status] : '';
	}
	
	public function scopeTypeCoffee($scope) {
		return $scope->where($this->table . '.type', '=', self::TYPE_COFFEE);
	}
	
	public function scopeTypeRestaurant($scope) {
		return $scope->where($this->table . '.type', '=', self::TYPE_RESTAURANT);
	}
	
	public function scopeTypeBarLounge($scope) {
		return $scope->where($this->table . '.type', '=', self::TYPE_BAR_LOUNGE);
	}
	
	public function scopeOrdered($scope) {
		return $scope->orderBy($this->table . '.order_no', 'asc');
	}
}
