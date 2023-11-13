<?php
class usuariosviews
{

    function mostrar($albumes, $categorias)
    {
        require 'templates/header.phtml';
        require 'templates/listado.phtml';
        require 'templates/footer.phtml';



    }

    function mostrardetallado($items, $categorias)
    {
        require 'templates/header.phtml';
        require 'templates/mostrardetallado.phtml';
        require 'templates/footer.phtml';


    }

    function mostrarcategorias($categorias)
    {
        require 'templates/header.phtml';
        require 'templates/categorias.phtml';
        require 'templates/footer.phtml';

    }

    function mostraradmi($items, $categorias)
    {
        require 'templates/header.phtml';

        require 'templates/form.phtml';
        require 'templates/footer.phtml';

    }

    function forumularioalbum($categorias)
    {
        require 'templates/header.phtml';

        require 'templates/agregar.categorias.phtml';
        require 'templates/footer.phtml';

    }

    function editaralbum($categorias, $id)
    {
        require 'templates/header.phtml';
        require 'templates/editaralbum.phtml';
        require 'templates/footer.phtml';


    }

    function editarcategoria($id)
    {
        require 'templates/header.phtml';
        require 'templates/editarcategoria.phtml';
        require 'templates/footer.phtml';

    }

    function authviews($error = null)
    {
        require 'templates/header.phtml';

        require 'templates/form.login.phtml';
        require 'templates/footer.phtml';

    }

    function errores($error = null)
    {
        require 'templates/errores.phtml';
    }



}


