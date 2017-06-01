<?php
use NoahBuscher\Macaw\Macaw;
Macaw::get("/Home-index/GetArray.html", "\App\Home\Controller\IndexController@Home");

Macaw::get('/(:any)/(:any)/(:any)', function ($Module, $Controller, $Action) {
	echo $Module . $Controller . $Action;
});
Macaw::error(function () {
	echo '404';
});
Macaw::dispatch();