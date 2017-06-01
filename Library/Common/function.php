<?php


function View($Path=""){
	if(!$Path){
		global $ViewPath;
		$ViewPath = explode("\\",$ViewPath);
		$ViewPath[2] = explode("Controller",$ViewPath[2]);
		$ViewPath[2] = $ViewPath[2][0];
		return APP_PATH."/".$ViewPath[0]."/View/".$ViewPath[2]."/".$ViewPath[3].".blade.php";
	}else{
		return APP_PATH."/".$Path.".blade.php";
	}
}

function M($TABLE_NAME=""){
	return new DB($TABLE_NAME);
}