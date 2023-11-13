<?php

class usuariosprivatemodels{

    function __construct(){
        $this->db= $this->getconection();
    }

private function getconection(){
    return new PDO('mysql:host=localhost;'.'dbname=db_tienda_de_musica;charset=utf8', 'root', '');


}
//Devueleve a un usurio por su mail;
function usuariosporemail($email){

    $query =$this->db->prepare('SELECT * FROM usuarios WHERE  email=?');
    $query->execute([$email]);
    return $query->fetch(PDO::FETCH_OBJ);


}
}