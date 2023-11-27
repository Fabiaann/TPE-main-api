<?php
require_once './app/views/apiview.php';

abstract class apiController {
    protected $view;
    private $data;

    function __construct() {
        $this->view = new apiView();
        $this->data = file_get_contents('php://input');
    }

    function getData() {
        return json_decode($this->data);
    }
}
?>