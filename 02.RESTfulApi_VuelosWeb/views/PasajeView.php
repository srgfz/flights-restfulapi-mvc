<?php

class PasajeView {
    //MÉTODOS DE LA VISTA:

    /**
     * showHeader() --> Función para mostrar el header de la página
     * @param type $vuelos --> Array de los vuelos
     * @param type $vueloId --> Id del vuelo (por defecto será null)     */
    public function showHeader($vuelos, $vueloId = null) {
        showHeader($vuelos, $vueloId);
    }
    
    /**
     * listPasajes() --> Función para listar los pasajes en una tabla
     * @param type $pasajes --> Array con los objetos de los pasaajes a listar
     */
    public function listPasajes($pasajes) {
        echo "<section class='col-10 mx-auto my-5 shadow bg-secondary bg-opacity-25'>";
        listPasajes($pasajes);
        echo "</section>";
    }
    
    /**
     * listPasajeros() --> Función para listar los pasajeros de un vuelo en una tabla
     * @param type $pasajeros --> Array con los objetos de los pasajeros
     */
    public function listPasajeros($pasajeros) {
        echo "<section class='col-10 mx-auto my-5 shadow bg-secondary bg-opacity-25'>";
        listPasajeros($pasajeros);
        echo "</section>";
    }

    /**
     * showAlert() --> Función para mostrar un alert
     * @param type $textContent --> Contenido del alert
     * @param type $alertType --> Tipo de alert a mostrar (clase Bootstrap)
     */
    public function showAlert($textContent, $alertType) {
        printAlert($textContent, $alertType);
    }

    /**
     * showFormAddPasaje() --> Función para mostrar el formulario para añadir o modificar un pasaje
     * @param type $vuelos --> Array con los vuelos para mostrarlos en el select
     * @param type $pasajeros --> Array con los pasajeros para mostrarlos en el select
     * @param type $pasaje --> Pasaje que se desea modificar (su existencia o no determinará si el formulario es para añadir un nuevo pasaje o modificarlo)
     */
    public function showFormAddPasaje($vuelos, $pasajeros, $pasaje) {
        if (isset($pasaje)) {
            echo"<h2 class='text-light mx-auto col-10 my-4'>Editar Pasaje</h2>";
        } else {
            echo"<h2 class='text-light mx-auto col-10 my-4'>Añadir Pasaje</h2>";
        }
        echo "<div class='col-8 mx-auto shadow bg-secondary bg-opacity-25 p-5 d-flex justify-content-center mb-5'>";
        showFormAddPasaje($vuelos, $pasajeros, $pasaje);
        echo "</div>";
    }

}
