<?php
include_once 'app/models/categorias.models.php';
include_once 'app/views/album.views.php';
class categoriascontrollers{

    private $views;
    private $model;

    public function __construct(){
        
        $this->views= new albumviews();
        $this->model= new categoriasmodels();
      
    }

    
    function vercategorias($id){
  
       

      
            $categorias= $this->model->obtener($id);
              //OBTINEN LAS TAREAS DEL MODELO
             
               
       
        $this->views->mostrarcategorias($categorias);
  
      
      }
      function mostraritems(){
        
        $items= $this->model->obtenerdetallado($id);
              //OBTINEN LAS TAREAS DEL MODELO
             
               
       
        $this->views->mostrar($items);

      }


}