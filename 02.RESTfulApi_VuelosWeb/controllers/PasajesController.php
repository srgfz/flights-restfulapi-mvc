<?php

class PasajesController {

    //Instanciamos del modelo y de la vista correspondiente:
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PasajeModel();
        $this->view = new PasajeView();
    }

    //Funciones del controlador Pasajes:

    /**
     * listPasajes() --> Función que controla el listado de los Pasajes
     * Controla el header y la tabla con el listado de los pasajes
     */
    public function listPasajes() {
        $vuelos = $this->model->getAllVuelos();
        $this->view->showHeader($vuelos);
        //Aviso al usuario si ha actualizado o añadido un pasaje:
        $msj = filtrarInput("msj", "GET");
        if (isset($msj)) {
            if (str_contains($msj, "Error")) {//Se ha producido algún error
                $this->view->showAlert($msj, "alert-danger");
            } else {//La acción se ha completado correctamente
                $this->view->showAlert($msj, "alert-info");
            }
        }
        $pasajes = $this->model->getAllPasajes();
        $this->view->listPasajes($pasajes);
    }
    
    /**
     * pasajesVuelo() --> Función que controla la información para los pasajes de un vuelo en específico
     */
    public function pasajesVuelo() {
        $vueloId = filtrarInput("vueloSelected", "POST");
        if ($vueloId) {//
            $vuelos = $this->model->getAllVuelos();
            $this->view->showHeader($vuelos, $vueloId);
            $pasajeros = $this->model->getAllPasajeros_Vuelo($vueloId);
            $this->view->listPasajeros($pasajeros);
        } else {//Si no hay vueloId
            header("Location: index.php");
        }
    }

    /**
     * addPasajeForm() --> Función que controla el formulario de añadir o editar un pasaje
     * También controlará el header
     */
    public function addPasajeForm() {
        //Si el origen es para modificar un pasaje el id del pasaje lo paso por GET
        $idPasaje = filtrarInput('idPasaje', 'GET');
        $msj = filtrarInput("msj", "GET");
        $pasaje = null;
        if (isset($idPasaje) && $idPasaje != "") {//Si existe el id pasaje 
            $pasaje = $this->model->getOnePasaje($idPasaje);
            if (is_string($pasaje) && str_contains($pasaje, "No existe el pasaje")) {
                $pasaje = null;
            }
        }
        $vuelos = $this->model->getAllVuelos();
        $pasajeros = $this->model->getAllPasajeros();
        $this->view->showHeader($vuelos);
        //Aviso al usuario si no ha introducido algún dato:
        if (isset($msj)) {
            if ($msj == 1) {//Ha intentado añadir
                $this->view->showAlert("Debe completar todos los campos para añadir un nuevo pasaje", "alert-warning");
            } else if ($msj == 2) {//Ha intentado modificar
                $this->view->showAlert("Debe completar todos los campos para modificar un pasaje", "alert-warning");
            } else if (str_contains($msj, "Error")) {//Si no se ha podido actualizar o añadir el pasaje
                $this->view->showAlert($msj, "alert-warning");
            }
        }
        $this->view->showFormAddPasaje($vuelos, $pasajeros, $pasaje);
    }

    /**
     * addPasaje() --> Función para añadir un nuevo registro mediante POST
     */
    public function addPasaje() {
        //Guardo los datos del pasaje a añadir
        $pasajerocod = filtrarInput("pasajerocod", "POST");
        $identificador = filtrarInput("identificador", "POST");
        $pvp = filtrarInput("pvp", "POST");
        $clase = filtrarInput("clase", "POST");
        $numasiento = filtrarInput("numasiento", "POST");
        if (!isset($pasajerocod) || !isset($identificador) || !isset($pvp) || !isset($clase) || !isset($numasiento)) {//Si algún campo no está cumplimentado
            header("Location: index.php?controller=Pasajes&action=addPasajeForm&msj=1");
        } else {
            $pasaje = array(
                "pasajerocod" => $pasajerocod,
                "identificador" => $identificador,
                "numasiento" => $numasiento,
                "clase" => $clase,
                "pvp" => $pvp,
            );
            $msj = $this->model->cURL(PASAJES, "POST", $pasaje);
            if (str_contains($msj, "Error")) {//Si se da algún error redirijo al mismo formulario indicando el error
                header("Location: index.php?controller=Pasajes&action=addPasajeForm&msj=$msj");
            } else {//Si la actualización se ha realizado correctamente
                header("Location: index.php?controller=Pasajes&action=listPasajes&msj=$msj");
            }
        }
    }

    /**
     * updatePasaje)= --> Función para controlar la actualización de un pasaje mediante PUT
     */
    public function updatePasaje() {
        //Guardo los datos del pasaje a actualizar
        $idpasaje = filtrarInput("id", "GET");
        $pasajerocod = filtrarInput("pasajerocod", "POST");
        $identificador = filtrarInput("identificador", "POST");
        $pvp = filtrarInput("pvp", "POST");
        $clase = filtrarInput("clase", "POST");
        $numasiento = filtrarInput("numasiento", "POST");
        echo "$idpasaje, $pasajerocod, $identificador, $pvp, $clase, $numasiento";
        if (!isset($pasajerocod) || !isset($identificador) || !isset($pvp) || !isset($clase) || !isset($numasiento)) {//Si algún campo no está cumplimentado
            header("Location: index.php?controller=Pasajes&action=addPasajeForm&msj=2&idPasaje=$idpasaje");
        } else {
            $pasaje = array(
                "pasajerocod" => $pasajerocod,
                "identificador" => $identificador,
                "numasiento" => $numasiento,
                "clase" => $clase,
                "pvp" => $pvp,
            );
            $msj = $this->model->cURL(PASAJES . "?id=$idpasaje", "PUT", $pasaje);
            if (str_contains($msj, "Error")) {//Si se da algún error redirijo al mismo formulario indicando el error
                header("Location: index.php?controller=Pasajes&action=addPasajeForm&idPasaje=$idpasaje&msj=$msj");
            } else {//Si la actualización se ha realizado correctamente
                header("Location: index.php?controller=Pasajes&action=listPasajes&msj=$msj");
            }
        }
    }

    /**
     * deletePasaje() --> Función para borrar un pasaje mediante DELETE
     */
    public function deletePasaje() {
        //Guardo el id del pasaje a borrar
        $idPasaje = filtrarInput("idPasaje", "GET");
        echo $idPasaje;
        //Borro el registro:
        $msj = $this->model->cURL(PASAJES . "?id=$idPasaje", "DELETE");
        header("Location: index.php?controller=Pasajes&action=listPasajes&msj=$msj");
    }

}
