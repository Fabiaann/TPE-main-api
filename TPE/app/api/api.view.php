<?php

class APIview
{

  public function response($data, $status)
  {
    //convierte a json

    header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
    header("Content-Type: application/json");

    echo json_encode($data);

  }
  private function requestStatus($code)
  {
    $status = array(
      200 => "OK",
      201 => "Created",
      400 => "Bad Request",
      404 => "Not found"
    );
    return (isset($status[$code])) ? $status[$code] : $status[500];
  }

}