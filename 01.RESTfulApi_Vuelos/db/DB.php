<?php

//Añado la configuración de la base de datos
require_once __DIR__ . '/../config/dbconfig.php';

abstract class DB {

    protected $db;

//Constructor
    public function getConexion() {//En el constructor creo la conexión a la BD
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DBUSER, DBPASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->db;
        } catch (Exception $ex) {//Si hay algún problema al hacer la conexión lanzo una excepción para indicar al usuario que la DB no está disponible
            $this->mensajeerror = $ex->getMessage();
            //header("Location: ./errorDB.php");
        }
    }

//Métodos propios de la clase

    /**
     * closeDB() --> método para cerrar la conexión a la DB
     */
    private function closeDB() {
        $this->db = null;
    }

    /**
     * getMesajeError() --> método para devolver el error de la base de datos
     * @return type --> Error de la base de datos
     */
    public function getMensajeError() {
        return $this->mensajeerror;
    }

}
