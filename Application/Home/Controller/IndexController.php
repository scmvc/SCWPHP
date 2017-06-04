<?php

namespace App\Home\Controller;
use BaseController\Controller;

class IndexController extends Controller {

	public function Home() {
		$this->assign("title", "123123");
		$this->assign("name", "aaa");
		$this->display();
	}
}