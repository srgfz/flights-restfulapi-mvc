<?php

class PasajeModel {
    
    /**
     * getAllVuelos() --> Función para hacer una petición GET a la api de todos los registros de los vuelos
     * @return type --> array de objetos stdClass con todos los vuelos
     */
    public function getAllVuelos() {
        return json_decode(file_get_contents(VUELOS));
    }
    
    /**
     * getAllPasajes() --> Función para hacer una petición GET a la api de todos los pasajes
     * @return type --> array de objetos stdClass con todos los pasajes
     */
    public function getAllPasajes() {
        return json_decode(file_get_contents(PASAJES));
    }

    /**
     * getAllPasajeros()--> Función para hacer una petición GET a la api de todos los Pasajeros
     * @return type --> array de objetos stdClass con todos los pasajeros
     */
    public function getAllPasajeros() {
        return json_decode(file_get_contents(PASAJEROS));
    }

    /**
     * getAllPasajeros_Vuelo() --> Función para hacer una petición GET a la api de todos los Pasajeros para un vuelo específico
     * @param type $id --> Será el identificador del vuelo del que se desean conocer todos sus pasajeros
     * @return type --> array de objetos stdClass con todos los pasajeros para el vuelo $id
     */
    public function getAllPasajeros_Vuelo($id) {
        return json_decode(file_get_contents(PASAJEROS . "?id=" . $id));
    }

    /**
     * getOnePasaje() --> Función para hacer una petición GET a la api de un pasaje en específico
     * @param type $id --> id del pasaje que se desea conocer
     * @return type --> Objeto stdClass con el pasaje consultado
     */
    public function getOnePasaje($id) {
        return json_decode(file_get_contents(PASAJES . "?id=" . $id));
    }

    /**
     * cURL() --> Función para ejecutar peticiones a la api mediante curl
     * @param type $url -->  endpoint de la api
     * @param type $method --> Método de la petición
     * @param type $data --> datos que se desean mandar en la petición en el body
     * @return type --> Mensaje o respuesta de la api
     */
    public function cURL($url, $method, $data=null) {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type:application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

}
