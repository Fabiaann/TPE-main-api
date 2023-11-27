<?php
require_once 'libs/Router.php';
require_once 'app/api/api.albumes.controllers.php';


$router = new Router();

//TABLA DE RUTEO

$router->addRoute('album', 'GET', 'ApiAlbumesController', 'getALL');
$router->addRoute('album/:ID', 'GET', 'ApiAlbumesController', 'getbyid');

$router->addRoute('venta/:ID', 'PUT', 'ApiVentasController', 'update');
$router->addRoute('venta/:ID/:filtro', 'GET', 'ApiVentasController', 'get');

$router->addRoute('album/:ID/:filter', 'GET', 'ApiAlbumesController', 'getallbyfilter');
$router->addRoute('sugerencia', 'GET', 'ApiAlbumesController', 'getAllalbumsugerido');
$router->addRoute('sugerencia', 'POST', 'ApiAlbumesController', 'add');
$router->addRoute('sugerencia/:ID', 'PUT', 'ApiAlbumesController', 'update');


//RUTEA

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']);


