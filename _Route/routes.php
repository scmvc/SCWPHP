<?php
use NoahBuscher\Macaw\Macaw;
Macaw::get("/","Home\Controller\IndexController@Home");
Macaw::get("/hello",function(){
	print_r($_GET);
});
Macaw::error(function() {
  echo '404';
});
Macaw::dispatch();