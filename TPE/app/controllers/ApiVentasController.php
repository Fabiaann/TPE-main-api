<?php

require_once './app/controllers/apiController.php';
require_once './app/models/ventasModel.php';

class ApiVentasController extends apiController {
    
    private $model;

    public function __construct() {
        parent::_construct();
        $this->model = new VentasModel();
    }

    public function get($params = []) {
        if(empty($params)) {
            $order = isset($_GET['order']) ? strtoupper($_GET['order']) : 'ASC';
            $field = isset($_GET['field']) ? strtolower($_GET['field']) : 'nombre_album':
            $filterBy = isset($_GET['filterBy']) ? strtolower($_GET['filterBy']) : 'null';
            $filterValue = isset($_GET['filterValue']) ? ucfirst($_GET['filterValue']) : 'null';
            $limit = isset($_GET['limit']) ? ($_GET['limit']) : 'null';
            $offset = isset($_GET['offset']) ? ($_GET['offset']) : 'null';

            $ventas = $this->model->getVentas($order, $field, $filterBy, $filterValue, $limit, $offset);
            $this->view->response($ventas, 200);
        }
        else {
            $ventas = $this->model->getById($params[':ID']);
            if (!empty($ventas)) {
                if(!empty($params[':filtro'])){
                    switch($params[':filtro']){
                        case 'nombre_album':
                            $this->view->response($ventas->nombre_album, 200);
                            break;
                        case 'id_album':
                            $this->view->response($ventas->id_album, 200);
                            break;
                        default:
                            $this->view->response('No se encontro '. $params['filtro']. '.', 404);
                            
                    }
                    else {
                        $this->view->response($ventas->200);
                    }
                    else {
                        $this->view->response("No se encontro la venta: ".$params['nombre_album'], 404);
                    }
                }
            }
        }
    }

    function create ($params = []) {
        $data = $this->getData();
        $nombre_album = $data->nombre_album;
        $id_album = $data->id_album;
        $via = $data->via;
        $tipo = $data->tipo;
        $precio = $data->precio;

        if (empty($nombre_album) || empty($id_album) || empty($via) || empty($tipo) || empty($precio)) {
            $this->view->response("Faltan datos", 400);
        }
        else {
            $id = $this->model->insertVenta($nombre_album,$id_album,$via,$tipo,$precio);
            $venta = $this->model->getById($id);
            $this->view->response($venta, 201);
        }
    }
    
    function update($params = []) {
        $id = $params[':ID'];
        $venta = $this->model->getById($id);

        if ($venta) {
            $data = $this->getData();
            $nombre_album = $data->nombre_album;
            $id_album = $data->id_album;
            $via = $data->via;
            $tipo = $data->tipo;
            $precio = $data->precio;

            if (empty($nombre_album) || empty($id_album) || empty($via) || empty($tipo) || empty($precio)) {
                $this->view->response("Faltan datos", 400);
            }
            $this->model->updateVenta($id,$id_album,$nombre_album,$via,$tipo,$precio);
            $this->view->response($venta->nombre_album. "actualizada", 200);
        }
        else {
            $this->view->response("No se encontro la venta: ".$id, 404);
        }
    }

    public function delete($params = []) {
        $id = $params[':ID'];
        $venta = $this->model->getById($id);

        if ($venta) {
            $this->model->deleteVenta($id);
            $this->view->response($venta->nombre_album. "eliminada", 200);
        }
        else {
            $this->view->response("No se encontro la venta: ".$id, 404);
        }
    }
}
?>