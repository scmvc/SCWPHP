<?php  
namespace App\Api\Controller;
use BaseController\Controller;

class Test extends Controller {

	function __construct(){

	}

	Public function Index(){
		echo 123;
		echo 456;
		//$buy= \App\Api\Model\Xy28_buy::get()->toArray();
		echo '<pre>';
		//print_r($buy);
		echo '</pre>'		
	}
}
?>