<?php

namespace Home\Controller;
use Home\Model\Test;
use BaseController\Controller;
class IndexController extends Controller
{
	public function Home(){
		$res = M("test")->get();
		print_r($res);
		include View();
	}
}