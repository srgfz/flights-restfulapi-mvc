<?php

class PasajeroModel extends DB {

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
            $sql = "SELECT idpasaje, pasajero.pasajerocod, nombre, pais, numasiento, clase, pvp 
                FROM pasaje INNER JOIN $this->table ON pasaje.pasajerocod=pasajero.pasajerocod WHERE pasaje.identificador = ? GROUP BY idpasaje";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $id);
            $stm->execute();
            $row = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
            return "No existe el pasaje $id";
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
            $sql = "SELECT * FROM $this->table";
            $stm = $this->conexionDB->query($sql);
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                // Retorna el array de registros
                return $results;
            } else {
                return "Actualmente no hay registros de pasajeros";
            }
        } catch (PDOException $e) {
            return "ERROR --> " . $e->getMessage();
        }
    }

}
