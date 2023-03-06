<?php

class VueloView {
    //MÉTODOS DE LA VISTA:

    /**
     * showHeader() --> Función para mostrar el header de la página
     * @param type $vuelos --> Array de los vuelos
     * @param type $vueloId --> Id del vuelo (por defecto será null)
     */
    public function showHeader($vuelos, $vueloId = null) {
        showHeader($vuelos, $vueloId);
    }
    
    /**
     * listVuelos() --> Función para listar en una tabla todos los vuelos
     * @param type $vuelos --> array con los objetos de los vuelos a listar
     * @param type $vueloId --> Id del vuelo seleccionado (Por defecto será null)
     */
    public function listVuelos($vuelos, $vueloId = null) {
        echo "<section class='col-10 mx-auto my-5  shadow bg-secondary bg-opacity-25'>";
        listVuelos($vuelos, $vueloId);
        echo "</section>";
    }

}
