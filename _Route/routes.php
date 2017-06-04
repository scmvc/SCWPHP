<?php
use NoahBuscher\Macaw\Macaw;
Macaw::get("/", "App\Home\Controller\IndexController@Home");
Macaw::get("/hello", function () {
	print_r($_GET);
});
Macaw::dispatch();