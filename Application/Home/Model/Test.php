<?php
namespace Home\Model;
use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
	protected $table = "test";
	// public $timestamps = false;
	// protected $dateFormat = 'U';
	// protected $connection = 'connection-name';
	
	public static function getAll(){
		return self::get()->toArray();
	}
}