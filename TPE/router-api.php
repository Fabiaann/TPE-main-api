<?php
require_once 'libs/Router.php';
require_once 'app/api/api.albumes.controllers.php';


$router= new Router() ;

//TABLA DE RUTEO

$router->addRoute('home','GET','ApiAlbumesController','getALL') ;
$router->addRoute('home/:ID','GET','ApiAlbumesController','get') ;
$router->addRoute('home:filter','GET','ApiAlbumesController','getallbyfilter') ;
$router->addRoute('albumes','POST', 'ApiAlbumesController','add');
$router->addRoute('home/:ID','DELETE','ApiAlbumesController','delete') ;
$router->addRoute('albumes/:ID','PUT','ApiAlbumesController','update');


//RUTEA

$router->route($_REQUEST['resource'], $_SERVER['REQUEST_METHOD']) ;


 