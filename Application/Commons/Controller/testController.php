<?php
class testController extends Controller {
   public function index(){
       $this->assign('name','windows10');
       $this->dispaly();
   }
}