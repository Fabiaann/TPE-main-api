<?php
include_once 'app/models/album.models.php';
include_once 'app/views/usuarios.views.php';
class administracioncontrollers
{

  private $models;
  private $view;


  function __construct()
  {

    $this->models = new albummodels();

    $this->view = new usuariosviews();
  }

  function veralbum()
  {




    $this->chequeoregistro();
    $albumes = $this->models->obtener();
    $categorias = $this->models->obtenercategorias();

    $this->view->mostraradmi($albumes, $categorias);

  }

  function agregaralbum()
  {
    $this->chequeoregistro();


    $nombre = $_POST['nombre'];
    $canciones = $_POST['canciones'];
    $duracion = $_POST['duracion'];
    $artista = $_POST['artista'];
    $genero = $_POST['genero'];
    $lanzamiento = $_POST['lanzamiento'];


    if (empty($nombre) || empty($canciones) || empty($duracion) || empty($genero) || empty($lanzamiento)) {
      $this->view->errores('complete los campos requeridos.');
    } else {
      $this->models->insertaralbum($nombre, $canciones, $duracion, $artista, $genero, $lanzamiento);
      header("Location:" . BASE_URL . "listar");

    }

  }

  function borraralbum($id)
  {
    $this->models->borraralbum($id);
    header('location:' . BASE_URL . "listar");


  }

  function editaralbum($id)
  {
    $nombre = $_POST['nombre'];
    $canciones = $_POST['canciones'];
    $duracion = $_POST['duracion'];
    $artista = $_POST['artista'];
    $lanzamiento = $_POST['lanzamiento'];
    $genero = $_POST['genero'];


    if (empty($nombre) || empty($canciones) || empty($duracion) || empty($genero) || empty($lanzamiento)) {
      $this->view->errores('complete los campos requeridos.');
    } else {



      $this->models->editaralbum($nombre, $canciones, $duracion, $artista, $lanzamiento, $genero, $id);
      header('location:' . BASE_URL . "listar");

    }
  }

  function veredicion($id)
  {
    $this->chequeoregistro();
    $categorias = $this->models->obtenercategorias();
    $this->view->editaralbum($categorias, $id);


  }

  function agregarcategorias()
  {


    $genero = $_POST['genero'];



    if (empty($genero)) {
      $this->view->errores('complete los campos requeridos.');
    } else {
      $this->models->insertarcategorias($genero);
      header("Location:" . BASE_URL . "formularioalbum");

    }

  }

  function borrarcategorias($id)
  {
    $this->models->borrarcategorias($id);
    header('location:' . BASE_URL . "formularioalbum");




  }

  function editarcategoria($id)
  {

    $genero = $_POST['genero'];

    if (empty($genero)) {
      $this->view->errores('complete los campos requeridos.');
    } else {
      $this->models->editarcategorias($genero, $id);
      header("Location:" . BASE_URL . "formularioalbum");

    }
  }
  function chequeoregistro()
  {
    session_start();
    if (!isset($_SESSION['ID_USUARIO'])) {
      header("Location: " . BASE_URL . "home");

    }
  }

  function edicioncategoria($id)
  {
    $this->chequeoregistro();
    $this->view->editarcategoria($id);
  }

  function formularioalbum()
  {
    $this->chequeoregistro();


    $categorias = $this->models->obtenercategorias();
    $this->view->forumularioalbum($categorias);

  }

  public function MostrarError($error)
  {
    $this->view->errores($error);
  }
}





