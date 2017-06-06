<?php 
namespace System;
/**
* 语言处理
*/
class  Lang implements \ArrayAccess
{
	protected $langs=array();
	
	    //ArrayAccess接口,检测服务是否存在
    public function offsetExists($offset) {
        return $this->has($offset);
    }
    
    //ArrayAccess接口,以$di[$name]方式获取服务
    public function offsetGet($offset) {
        return $this->get($offset);
    }
    
    //ArrayAccess接口,以$di[$name]=$value方式注册服务，非共享
    public function offsetSet($offset, $value) {
        return $this->set($offset,$value);
    }
    
    //ArrayAccess接口,以unset($di[$name])方式卸载服务
    public function offsetUnset($offset) {
        return $this->remove($offset);
    }
     //检测是否已经绑定
    public function has($key){
        return isset($this->langs[$key]);
    }
    
    //卸载服务
    public function remove($key){
        unset($this->langs[$key]);
    }
    
    //设置服务
    public function set($key,$value){
        $this->langs[$key]=$value;
    }
    public function get($key)
    {
    	if($this->has($key)){
    		return $this->langs[$key];
    	}
    	return;
    }

    function getAll(){
    	return $this->langs;
    }

    function load($data=array()){
    	$this->langs=$data;
    }    

}


 ?>