<?php

namespace App\Home\Controller;
use BaseController\Controller;

class IndexController extends Controller {
    public function Index(){
        echo 123;
    }
	public function Home() {
		$this->assign("title", "123123");
		$this->assign("name", "aaa");
		$this->display();
	}
}