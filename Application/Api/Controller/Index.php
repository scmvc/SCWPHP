<?php
/**
*------Create thems Controller------
*------SCWPHP  Version 1.0.0------
*------Dev Model Jions------
*------Create Time 2017-06-06 07:43:45------
*/
namespace App\Api\Controller;
use BaseController\Controller;

class index extends Controller {

	function __construct(){

	}

	Public function Index(){
		// $data=lm('account')->get()->toArray();
		// print_r($data);
	}
	public function showtime()
	{
		$data=lm('account')->get()->toArray();		
		echo lang()->get('hello world');
		dump($data);

	}
}
