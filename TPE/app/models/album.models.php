<?php
class albummodels
{


    function __construct()
    {
        $this->db = $this->getconection();
    }

    private function getconection()
    {
        return new PDO('mysql:host=localhost;' . 'dbname=db_tienda_de_musica;charset=utf8', 'root', '');


    }

    function obtener($OrderBy = null, $OrderModel = null,$startAt=null,$endAt=null)
    {
      
        //ordena datos pero no limita para paginar.
        if ($OrderBy != null && $OrderModel != null && $startAt== null && $endAt==null) {
            $sql = "SELECT * FROM album ORDER BY $OrderBy $OrderModel";
        } 

        //ahora limita y ordena.
        if ($OrderBy != null && $OrderModel != null && $startAt != null && $endAt != null) {
            $sql = "SELECT * FROM album ORDER BY $OrderBy $OrderModel LIMIT $startAt, $endAt ";
        } 
        //solo limita, no ordena.
        if ($OrderBy == null && $OrderModel == null && $startAt != null && $endAt != null) {
            $sql = "SELECT * FROM album LIMIT $startAt, $endAt ";
        } 
        if ($OrderBy == null && $OrderModel == null && $startAt == null && $endAt == null) {
            $sql = "SELECT * FROM album  ";
        } 
       
        
    



        $query = $this->db->prepare($sql);
        $query->execute();
        //cargas es un arreglo de cargas
        $albumes = $query->fetchall(PDO::FETCH_OBJ);
        return $albumes;

    }

    function getfilter($LinkTo = null, $EqualTO = null)
    {


        if ($LinkTo != null && $EqualTO != null) {

            $sql = "SELECT * FROM album WHERE $LinkTo = :$LinkTo ";
            $query = $this->db->prepare($sql);
            $query->bindParam(":" . $LinkTo, $EqualTO, PDO::PARAM_STR);
            $query->execute();
            //cargas es un arreglo de cargas

            return $query->fetchAll(PDO::FETCH_CLASS);


        } else {
            $sql = 'SELECT * FROM album';

        }



        $query = $this->db->prepare($sql);
        $query->execute();
        //cargas es un arreglo de cargas
        $albumes = $query->fetchall(PDO::FETCH_OBJ);
        return $albumes;

    }




    function obtenerdetallado($id)
    {

        $query = $this->db->prepare('SELECT * FROM `album` WHERE id_album = ?');
        $query->execute([$id]);
        $items = $query->fetchall(PDO::FETCH_OBJ);
        return $items;
    }


    function obtenercategorias()
    {

        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        $categorias = $query->fetchall(PDO::FETCH_OBJ);
        return $categorias;

    }

    function albumxcategoria($id_categoria)
    {

        $query = $this->db->prepare('SELECT album.nombre, album.id_album, categorias.genero as categoria FROM album JOIN categorias ON album.id_categoria = categorias.id_categoria WHERE album.id_categoria = ?');
        $query->execute([$id_categoria]);
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);

        return $categorias;
    }

    function insertaralbum($nombre, $canciones, $duracion, $artista, $genero, $lanzamiento)
    {


        $query = $this->db->prepare('INSERT INTO  album(nombre, canciones, duracion, artista,id_categoria,lanzamiento ) VALUES (?,?,?,?,?,?) ');
        $query->execute([$nombre, $canciones, $duracion, $artista, $genero, $lanzamiento]);
    }

    function borraralbum($id)
    {

        $query = $this->db->prepare('DELETE FROM album WHERE  id_album=?');
        $query->execute([$id]);

    }

    function editaralbum($nombre, $canciones, $duracion, $artista, $lanzamiento, $genero, $id)
    {
        $query = $this->db->prepare('UPDATE album SET nombre=?, canciones=?, duracion=?, artista=?,lanzamiento=?,  id_categoria = ? WHERE id_album = ? ');

        $query->execute([$nombre, $canciones, $duracion, $artista, $lanzamiento, $genero, $id]);

    }

    function insertarcategorias($genero)
    {
        $query = $this->db->prepare('INSERT INTO  categorias(genero) VALUES (?) ');
        $query->execute([$genero]);
    }

    function borrarcategorias($id)
    {

        $query = $this->db->prepare('DELETE FROM categorias WHERE  id_categoria=?');
        $query->execute([$id]);
    }


    function editarcategorias($genero, $id)
    {
        $query = $this->db->prepare('UPDATE categorias SET genero=? WHERE categorias.id_categoria = ? ');

        $query->execute([$genero, $id]);

    }

    function insertaralbumsugerido($nombre, $genero, $artista)
    {


        $query = $this->db->prepare('INSERT INTO  sugerencia(albumsugerido,generoalbumsugerido,artistaalbumsugerido) VALUES (?,?,?) ');
        $query->execute([$nombre, $genero, $artista]);

        return $this->db->lastInsertId();
    }

    function editaralbumsugerido($nombre, $genero, $artista, $id)
    {

        $query = $this->db->prepare('UPDATE   sugerencia SET albumsugerido=?,generoalbumsugerido=?,artistaalbumsugerido=? where =?');
        $result = $query->execute([$nombre, $genero, $artista, $id]);
        return $result;
    }
}