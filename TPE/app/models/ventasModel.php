<?php

include_once './app/models/model.php';

class VentasModel extends Model {
    
    function getAll($order, $field, $filterBy, $filterValue, $limit, $offset) {
        $sql = "SELECT ventas.*, venta.nombre as nombre FROM ventas JOIN nombre ON ventas.id_album=album.id";

        switch($filterBy) {
            case'via':
                $sql.= ' WHERE via = ' . '\''. $filterValue.'\'';
                break;
            case'id_album':
                $sql .= ' WHERE album.nombre = ' . '\'' . $filterValue.'\'';
                break;
            case'precio':
                $sql := ' WHERE precio = ' . '\'' . $filterValue.'\'';
                break;
            default:
                $sql .=' ';
                break;
        }
        switch($order) {
            case'ASC':
                $sql .= ' ORDER BY ' . $field . ' ASC';
                break;
            case'DESC':
                $sql .= ' ORDER BY ' . $field . ' DESC';
                break;
            default:
                $sql .= ' ORDER BY nombre_album ASC';
        }
        if($limit != 'null'){
            $sql .= ' LIMIT ' . $limit;
        }

        if($offset != 'null'){
            $sql .= ' OFFSET ' . $offset;
        }
        
        $query = $this->db->prepare($sql);

        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getById($id) {
        $query = $this->db->prepare('SELECT ventas.*, album.nombre as nombre FROM ventas JOIN nombre ON ventas.id_album=album.nombre WHERE id = ?');
        $query->execute([$id]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function insertVenta($nombre_album,$id_album,$via,$tipo,$precio) {
        $query = $this->db->prepare('INSERT INTO ventas (id,album_nombre,id_album,via,tipo,precio) VALUES(?,?,?,?,?,?)');
        $query->execute([$nombre_album,$id_album,$via,$tipo,$precio]);

        return $this->db->lastInsertId();
    }

    function deleteVenta($id) {
        $query = $this->db->prepare('DELETE FROM ventas WHERE id=?');
        $query->execute([$id]);
    }

    function updateVenta($id,$nombre_album,$id_album,$via,$tipo,$precio) {
        $query = $this->db->prepare('UPDATE ventas SET nombre_album=?,id_album=?,via=?,tipo=?,precio=? WHERE id=?');
        $query->execute([$nombre_album,$id_album,$via,$tipo,$precio,$id]);
    }
}
?>