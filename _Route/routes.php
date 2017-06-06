<?php

Route::get("/", "App\Home\Controller\IndexController@Home");
Route::get("/hello", function () {
	print_r($_GET);
});
Route::get("/dataSeeds", "App\Home\Controller\DataSeeds@Index");

Route::get("/(:any)/(:any)/(:any)/", function($proj,$controller,$method){
	return appExec($proj,$controller,$method);
});
Route::get("/(:any)/(:any)/(:any)", function($proj,$controller,$method){
	return appExec($proj,$controller,$method);
});
Route::get("/(:any)-(:any)/(:any).html",function($proj,$controller,$method){
	return appExec($proj,$controller,$method);
});
// Route::dispatch();