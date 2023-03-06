<?php

class VueloModel {
    
    /**
     * getAllVuelos() --> Función para hacer una petición GET a la api de todos los registros de los vuelos
     * @return type --> array de objetos stdClass con todos los vuelos
     */
    public function getAllVuelos() {
        return json_decode(file_get_contents(VUELOS));
    }
    
    /**
     * getAllOneVuelo() --> Función para hacer una petición GET a la api de un vuelo en específico
     * @param type $id --> Id del vuelo a consultar
     * @return type --> objeto stdClass del vuelo consultado
     */
    public function getAllOneVuelo($id) {
        return json_decode(file_get_contents(VUELOS."?id=".$id));
    }

}
