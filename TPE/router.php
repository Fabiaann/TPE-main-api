<?php
require_once './app/controllers/usuarios.controllers.php';
require_once 'app/controllers/administracion.controllers.php';
require_once 'app/controllers/auth.controllers.php';






define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}



// listar->Obtenercargas();
$params = explode('/', $action);

switch ($params[0]) {
 
    case 'home';
     $controllers= new usuarioscontrollers();
     $controllers->listado();
    break;
   
    case 'ver';
     $controller= new usuarioscontrollers();
     $controller->verdetallado($params[1]);
    break;

    case 'categorias';
     $controller=new usuarioscontrollers();
     $controller->vercategorias($params[1]);
    break;
    
    case 'formularioalbum';
    $controller = new administracioncontrollers();
    $controller->formularioalbum();
    break;

    case 'listar';
     $controller = new administracioncontrollers();
     $controller->veralbum();
    break;

    case 'agregar';
     $controller = new administracioncontrollers();
     $controller->agregaralbum();
    break;

    case 'borrar';
     $controller = new administracioncontrollers();
     $controller->borraralbum($params[1]);
    break;

    case 'editar';
     $controller=new administracioncontrollers();
     $controller->editaralbum($params[1]);
    break;

    case 'editaralbum';
     $controller=new administracioncontrollers();
     $controller->veredicion($params[1]);
    break;
    case 'agregarcategoria';
     $controller = new administracioncontrollers();
     $controller->agregarcategorias();
    break;

    case 'borrarcategoria';
     $controller = new administracioncontrollers();
     $controller->borrarcategorias($params[1]);
    break;

    case 'editarcategoria';
     $controller=new administracioncontrollers();
     $controller->editarcategoria($params[1]);
    break;

    case 'edicioncategoria';
     $controller=new administracioncontrollers();
     $controller->edicioncategoria($params[1]);
    break;

    

    case 'login';
     $controller = new authcontrollers();
     $controller->iniciosesion();
    break;

    case 'verify';
    $controller = new authcontrollers();
    $controller->loginusuario();
    break;

    case 'logout';
     $controller = new authcontrollers();
     $controller->logout();
     break;

  

    


   


    default: 
    
    $controller=new administracioncontrollers();
    $controller->MostrarError($error="¡PAGINA NO ENCONTRADA! verifique la direccion url e intentalo nuevamente");
  
    break;
    
   
}