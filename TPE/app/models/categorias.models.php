<?php


class categoriasmodels{

    function __construct(){
        $this->db= $this->getconection();
    }

private function getconection(){
    return new PDO('mysql:host=localhost;'.'dbname=db_tienda_de_musica;charset=utf8', 'root', '');


}
    function obtenerdetallado(){
        $query = $this->db->prepare('SELECT ab.genero, ab.nombre FROM album ab INNER JOIN categorias ct ON ab.id_categoria= ct.id_categoria');
       $query->execute();
       $categorias = $query->fetchAll(PDO::FETCH_OBJ);

   return $categorias;
    }

    function obtener(){

        $query = $this->db->prepare('SELECT * FROM categorias');
    $query->execute();
    //cargas es un arreglo de cargas
    $categorias = $query->fetchall(PDO::FETCH_OBJ);
    
    return $categorias;
    
}
}