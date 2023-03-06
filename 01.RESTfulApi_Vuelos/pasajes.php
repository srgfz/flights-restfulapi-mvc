<?php

require_once ('./db/DB.php');
require_once ('./models/PasajeModel.php');
$pasaje = new PasajeModel("pasaje");

@header("Content-type: application/json");

// Consultar GET
// devuelve o 1 o todos, dependiendo si recibe o no parámetro
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $results = $pasaje->getOne($_GET['id']);
        echo json_encode($results);
        exit();
    } else {
        $results = $pasaje->getAll();
        echo json_encode($results);
        exit();
    }
}
// Crear un nuevo reg POST
// Los campos del array que venga se deberán llamar como los campos de la tabla Departamentos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $res = "";
    // se cargan toda la entrada que venga en php://input: el body de la petición
    $post = json_decode(file_get_contents('php://input'), true);
    $res = $pasaje->checkPasaje($post);
    if (empty($res)) {//Si no hay problemas de inserción del pasaje
        $res = $pasaje->post($post);
    } else {//Si no puede insertar el registro añado cabecera al error:
        $res = "Error al insertar - " . $res;
    }
    echo json_encode($res);
    exit();
}

// Actualizar PUT, se reciben los datoc como en el put
// Los campos del array que venga se deberán llamar como los campos de la tabla Departamentos
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $res = "";
    // se cargan toda la entrada que venga en php://input: el body de la petición
    $post = json_decode(file_get_contents('php://input'), true);
    $res = $pasaje->checkPasaje($post);
    if (empty($res)) {//Si no hay problemas de inserción del pasaje
        $res = $pasaje->put($_GET["id"],$post);
    } else {//Si no puede insertar el registro añado cabecera al error:
        $res = "Error al actualizar - " . $res;
    }
    echo json_encode($res);
    exit();
}

// Borrar DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $resul = $pasaje->delete($_GET['id']);
    echo json_encode($resul);
    exit();
}

// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

