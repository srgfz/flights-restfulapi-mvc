<?php

require_once ('./db/DB.php');
require_once ('./models/PasajeroModel.php');
$pasajero = new PasajeroModel("pasajero");

@header("Content-type: application/json");

// Consultar GET
// devuelve o 1 o todos, dependiendo si recibe o no parámetro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $results["Pasajes del vuelo ".$_GET['id']] = $pasajero->getOne($_GET['id']);
        echo json_encode($results);
        exit();
    } else {
        $results = $pasajero->getAll();
        echo json_encode($results);
        exit();
    }
}

// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

