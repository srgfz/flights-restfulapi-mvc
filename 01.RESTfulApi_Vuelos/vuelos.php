<?php

require_once ('./db/DB.php');
require_once ('./models/VueloModel.php');
$vuelo = new VueloModel("vuelo");

@header("Content-type: application/json");

// Consultar GET
// devuelve o 1 o todos, dependiendo si recibe o no parámetro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $results = $vuelo->getOne($_GET['id']);
        echo json_encode($results);
        exit();
    } else {
        $results = $vuelo->getAll();
        echo json_encode($results);
        exit();
    }
}

// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

