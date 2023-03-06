<?php

class VuelosController {

    //Instanciamos del modelo y de la vista correspondiente:
    private $model;
    private $view;

    public function __construct() {
        $this->model = new VueloModel();
        $this->view = new VueloView();
    }

    //Funciones del controlador Vuelos:

    /**
     * listVuelos() --> Función que controla el listado de los vuelos
     */
    public function listVuelos() {
        $vuelos = $this->model->getAllVuelos();
        $this->view->showHeader($vuelos);
        $this->view->listVuelos($vuelos);
    }
    
    /**
     * infoVuelo() --> Función para controlar la información de un vuelo en específico
     */
    public function infoVuelo() {
        $vueloId = filtrarInput("vueloSelected", "POST");
        if ($vueloId) {//
            $vuelos = $this->model->getAllVuelos();
            $this->view->showHeader($vuelos, $vueloId);
            $vueloSelected = $this->model->getAllOneVuelo($vueloId);
            $this->view->listVuelos([$vueloSelected], $vueloId);
        } else {//Si no hay vueloId
            header("Location: index.php");
        }
    }

}
