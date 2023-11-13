<?php
include_once 'app/models/tienda.de.musica.php';
include_once 'app/views/usuarios.views.php';
class usuarios {
    private $models;
    private $views;

    function __construct(){
        $this->models= new tiendademusica();
        $this->views= new usuariosviews();
   
        

    }

    function listado(){

        $items= $this->models->obtener();
        $this->views->mostrar($items);
        //OBTINEN LAS TAREAS DEL MODELO
     
        
    }
  function ver(){
    $items= $this->models->obtener();
    $this->views->mostrardetallado($items);
 
  }
}