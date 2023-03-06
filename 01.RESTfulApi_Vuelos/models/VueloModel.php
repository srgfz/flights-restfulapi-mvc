<?php

class VueloModel extends DB {

    private $table;
    private $conexionDB;

    public function __construct($table) {
        $this->table = $table;
        $this->conexionDB = $this->getConexion();
    }

    //GET

    /**
     * getOne() --> Método para obtener un registro de la bd
     * @param type $id --> id del registro a buscar
     * @return type --> devuelve el registro de la DB referentes a la tabla del modelo y al $id indicado (Devuelve un mensaje de error en caso de darse)
     */
    public function getOne($id) {
        try {
            $sql = "SELECT vuelo.identificador, origen.codaeropuerto as 'aeropuerto_origen', origen.nombre as 'aeropuerto_origen_nombre', "
                    . "origen.pais as 'pais_origen', destino.codaeropuerto as 'aeropuerto_destino', destino.nombre as 'aeropuerto_destino_nombre', destino.pais as 'pais_destino', "
                    . "vuelo.tipovuelo, COUNT(pasaje.idpasaje) as 'pasajeros' FROM $this->table INNER JOIN (SELECT * FROM aeropuerto) as origen "
                    . "ON origen.codaeropuerto=vuelo.aeropuertoorigen INNER JOIN (SELECT * FROM aeropuerto) as destino "
                    . "ON destino.codaeropuerto=vuelo.aeropuertodestino LEFT JOIN pasaje "
                    . "ON pasaje.identificador=vuelo.identificador WHERE vuelo.identificador=? GROUP BY vuelo.identificador";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $id);
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
            return "No existe el vuelo $id";
        } catch (PDOException $e) {
            return "ERROR --> " . $e->getMessage();
        }
    }

    /**
     * getAll() --> Método para obtener todos los registros de la bd referentes al modelo
     * @return type --> devuelve todos los registros DB referentes a la tabla del modelo (Devuelve un mensaje de error en caso de darse)
     */
    public function getAll() {
        try {
            $sql = "SELECT vuelo.identificador, origen.codaeropuerto as 'aeropuerto_origen', origen.nombre as 'aeropuerto_origen_nombre', "
                    . "origen.pais as 'pais_origen', destino.codaeropuerto as 'aeropuerto_destino', destino.nombre as 'aeropuerto_destino_nombre', destino.pais as 'pais_destino', "
                    . "vuelo.tipovuelo, COUNT(pasaje.idpasaje) as 'pasajeros' FROM $this->table INNER JOIN (SELECT * FROM aeropuerto) as origen "
                    . "ON origen.codaeropuerto=vuelo.aeropuertoorigen INNER JOIN (SELECT * FROM aeropuerto) as destino "
                    . "ON destino.codaeropuerto=vuelo.aeropuertodestino LEFT JOIN pasaje "
                    . "ON pasaje.identificador=vuelo.identificador GROUP BY vuelo.identificador";
            $stm = $this->conexionDB->query($sql);
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                // Retorna el array de registros
                return $results;
            } else {
                return "Actualmente no hay registros de vuelos";
            }
        } catch (PDOException $e) {
            return "ERROR --> " . $e->getMessage();
        }
    }

}
