<?php
require_once 'app/models/album.models.php';
require_once 'app/views/usuarios.views.php';


class usuarioscontrollers
{

    private $models;
    private $views;

    function __construct()
    {
        $this->models = new albummodels();
        $this->views = new usuariosviews();





    }

    function listado()
    {
        session_start();

        $albumes = $this->models->obtener();

        $categorias = $this->models->obtenercategorias();


        $this->views->mostrar($albumes, $categorias);

    }

    function verdetallado($id)
    {

        session_start();

        $items = $this->models->obtenerdetallado($id);
        $categorias = $this->models->obtenercategorias();
        $this->views->mostrardetallado($items, $categorias);

    }


    function vercategorias($id)
    {

        session_start();

        $categorias = $this->models->albumxcategoria($id);
        $this->views->mostrarcategorias($categorias);

    }






}