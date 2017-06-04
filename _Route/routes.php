<?php
use Route\Route;
Route::get("/", "App\Home\Controller\IndexController@Home");
Route::get("/hello", function () {
	print_r($_GET);
});
Route::dispatch();