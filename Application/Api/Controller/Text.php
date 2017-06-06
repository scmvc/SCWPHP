<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 2017/6/6
 * Time: 17:57
 */

namespace App\Api\Controller;
use BaseController\Controller;
use App\Api\Model\Banner;

class Text extends Controller
{
    function index(){
        $model=new Banner(); //实例化model
        $data=$model->getlist();
        print_r($data);
    }
}