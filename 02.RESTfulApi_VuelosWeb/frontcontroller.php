<?php

session_start();
//Incluyo todos los archivos necesarios:
include "./resources/functions/frontControllerFunctions.php";
include "./resources/functions/filterFunctions.php";
include "./resources/functions/printHtmlFunctions.php";
//Controladores:
include "./controllers/VuelosController.php";
include "./controllers/PasajesController.php";
//Modelos:
include "./services/VueloModel.php";
include "./services/PasajeModel.php";
//Vistas:
include "./views/VueloView.php";
include "./views/PasajeView.php";
//Configuración (rutas) de la API
include "./config/apiConfig.php";

//Defino la acción y el controlador por defecto por defecto:
if (isset($_GET["controller"]) && $_GET["controller"] == "Pasajes") {//Acción por defecto de Pasaje
    define("DEFAULT_ACTION", "listPasajes");
} else {//Acción por defecto principal
    define("DEFAULT_ACTION", "listVuelos");
    define("DEFAULT_CONTROLLER", "Vuelos");
}



//Cargamos y ejecutamos el controlador y su acción correspondiente:
if (isset($_GET["controller"])) {//Si recibe un controlador ejecuto su acción
    $controller = loadController($_GET["controller"]);
    executeAction($controller);
} else {//En caso contrario ejecuto el controlador y la acción por defecto
    $controller = loadController(DEFAULT_CONTROLLER);
    executeAction($controller);
}