<?php
require_once 'app/api/api.view.php';
require_once 'app/models/album.models.php';

class ApiAlbumesController
{


  private $model;
  private $view;
  function __construct()
  {

    $this->model = new albummodels();
    $this->view = new APIview();
    $this->data = file_get_contents("php://input");
  }
//conviete la variable a json
  function getData(){ 
    return json_decode($this->data); 
} 

  public function getAll($params = null)
  {
    $startAt =$_GET["startAt"] ?? null;
    $endAt =$_GET["endAt"] ?? null;
  

    $OrderBy = $_GET["OrderBy"] ?? null;
    $OrderModel =$_GET["OrderModel"] ?? null;

    $validOrderBys = ["nombre", "canciones", "duracion", "artista", "lanzamiento"]; 
    $validOrderModels = ["ASC", "DESC"]; 
    if (
      //in_aaray comprueba que el valor exista en el arreglo.
      ($OrderBy !== null && !in_array($OrderBy, $validOrderBys)) || ($OrderModel !== null && !in_array($OrderModel, $validOrderModels))
  ) {
      $this->view->response("Posible error en valores  " ."(". $OrderBy .")". " o " ."(". $OrderModel .")", 404);
      return;
  }


   
  
    else{
    $albumes = $this->model->obtener($OrderBy,$OrderModel,$startAt,$endAt);
    $this->view->response($albumes, 200);}
    
  }
  public function getAllalbumsugerido($params = null)
  {
    $startAt =$_GET["startAt"] ?? null;
    $endAt =$_GET["endAt"] ?? null;
  

    $OrderBy = $_GET["OrderBy"] ?? null;
    $OrderModel =$_GET["OrderModel"] ?? null;

    $validOrderBys = ["nombre", "canciones", "duracion", "artista", "lanzamiento"]; 
    $validOrderModels = ["ASC", "DESC"]; 
    if (
      //in_aaray comprueba que el valor exista en el arreglo.
      ($OrderBy !== null && !in_array($OrderBy, $validOrderBys)) || ($OrderModel !== null && !in_array($OrderModel, $validOrderModels))
  ) {
      $this->view->response("Posible error en valores  " ."(". $OrderBy .")". " o " ."(". $OrderModel .")", 404);
      return;
  }


   
  
    else{
    $sugerencia  = $this->model->getalbumsugerido($OrderBy,$OrderModel,$startAt,$endAt);
    $this->view->response($sugerencia , 200);}
    
  }

  function getallbyfilter($params = null){
    $startAt=$_GET["startAt"] ?? null;
    $endAt=$_GET["endAt"] ?? null;

    $LinkTo=$_GET["linkto"];
    $EqualTO= $_GET["equalto"];
    if(!empty($LinkTo) ){
    if(isset($LinkTo) && isset($EqualTO)){
    $albumes = $this->model->getfilter($LinkTo,$EqualTO);
    $this->view->response($albumes, 200);}}
    else{
      $this->view->response("error", 400);
    }
    

  }

  public function getbyid($params = null)
  {

    $idAlbumes = $params[':ID'];
    $albumes = $this->model->obtenerdetallado($idAlbumes);
    if ($albumes) {
      $this->view->response($albumes, 200);

    } else {
      $this->view->response("el album con el id=$idAlbumes no existe", 404);

    }


  }

  public function delete($params = null)
  {
    $idAlbumes = $params[':ID'];

    $albumes = $this->model->obtenerdetallado($idAlbumes);
    if (!empty($albumes)) {

      $albumes = $this->model->borraralbum($idAlbumes);

      $this->view->response("el album con el id=$idAlbumes se elimino con exito", 200);
    } else {
      $this->view->response("el album con el id=$idAlbumes no existe", 404);

    }
  }

  public function add($params=null)
  {
    $body= $this->getData();
    
    $nombre =$body->nombre; 
    $genero =$body->genero;
    $artista =$body->artista;
    

    $id = $this->model->insertaralbumsugerido($nombre, $genero, $artista);

   if($id>0 && $id > 0 && isset($artista) && isset($genero) && $artista != null && $genero != null){

    $this->view->response("el album con el id=$id se creo exitosamente", 200);
   }
   else{
    $this->view->response("el album con el id=$id no pudo ser creado", 404);
   }
  }

  public function update($params=null)
  {
    $id=$params[':ID'];
    $body= $this->getData();
    
    $nombre =$body->nombre; 
    $genero =$body->genero;
    $artista =$body->artista;
    

    $realizado = $this->model->editaralbumsugerido($nombre, $genero, $artista,$id);

   if($realizado>0 && isset($artista) && isset($genero) && $artista != null && $genero != null){

    $this->view->response("el album con el id=$realizado se actualizo correctamente", 201);
   }
   else{
    $this->view->response("el album con el id=$realizado no pudo ser ser actualizado", 404);
   }
  }

}