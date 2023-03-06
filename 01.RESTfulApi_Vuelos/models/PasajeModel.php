<?php

class PasajeModel extends DB {

    private $table;
    private $conexionDB;

    public function __construct($table) {//Creo la conexión a la bd
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
            $sql = "SELECT * FROM $this->table WHERE idpasaje=?";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $id);
            $stm->execute();
            $row = $stm->fetch(PDO::FETCH_ASSOC);
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
            $sql = "select * from $this->table";
            $stm = $this->conexionDB->query($sql);
            $results = $stm->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                // Retorna el array de registros
                return $results;
            } else {
                return "Actualmente no hay registros de pasajes";
            }
        } catch (PDOException $e) {
            return "ERROR --> " . $e->getMessage();
        }
    }

    //POST
    
    /**
     * post() --> Función para hacer una insercción a la BD
     * @param type $post --> json con los parámetros a actualizar
     * @return string --> Devuelve un mensaje indicando si la inserción se ha realizado correctamente o si ha habido algún error
     */
    public function post($post) {
        try {
            $sql = "insert into $this->table values (?,?,?,?,?,?)";
            $stm = $this->conexionDB->prepare($sql);
            // extraemos los parámetros de la variable post
            $stm->bindParam(1, $post['idpasaje']);
            $stm->bindParam(2, $post['pasajerocod']);
            $stm->bindParam(3, $post['identificador']);
            $stm->bindParam(4, $post['numasiento']);
            $stm->bindParam(5, $post['clase']);
            $stm->bindParam(6, $post['pvp']);
            $num = $stm->execute();
            $msgPost = "Registro insertado correctamente";
        } catch (PDOException $e) {
            $msgPost = "Error al insertar -> " . $e->getMessage();
        }
        return $msgPost;
    }

    //PUT
    
    /**
     * put() --> Método para hacer una actualización a un registro en la BD
     * @param type $id --> id del registro a actualizar
     * @param type $post --> json con los parámetros a actualizar
     * @return string --> Devuelve un mensaje indicando si la actualización se ha realizado correctamente o si ha habido algún error
     */
    public function put($id, $post) {
        try {
            $sql = "update $this->table set pasajerocod=?, identificador=?, numasiento=?, clase=?, pvp=? where idpasaje=?";
            $stm = $this->conexionDB->prepare($sql);
            // extraemos los parámetros de la variable $post
            $stm->bindParam(1, $post['pasajerocod']);
            $stm->bindParam(2, $post['identificador']);
            $stm->bindParam(3, $post['numasiento']);
            $stm->bindParam(4, $post['clase']);
            $stm->bindParam(5, $post['pvp']);
            $stm->bindParam(6, $id);
            $num = $stm->execute();
            if ($stm->rowCount() == 0) {
                $msgPut = "Error al actualizar - No hay ningún registro del pasaje id $id";
            } else {
                $msgPut = "Registro $id actualizado correctamente";
            }
        } catch (PDOException $e) {
            $msgPut = "Error al actualizar --> " . $e->getMessage();
        }
        return $msgPut;
    }

    //DELETE
    
    /**
     * delete() --> Método para eliminar un registro de la bd a partir de su $id
     * @param type $id --> id del registro a eliminar
     * @return string --> Devuelve un mensaje indicando si la actualización se ha realizado correctamente o si ha habido algún error
     */
    public function delete($id) {
        try {
            $sql = "delete from $this->table where idpasaje= ? ";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $id);
            $num = $stm->execute();
            if ($stm->rowCount() == 0) {
                return "Error al borrar - El pasaje $id no existe";
            } else {
                return "Registro $id borrado correctamente";
            }
        } catch (PDOException $ex) {
            return "Error al borrar - " . $ex->getMessage();
        }
    }

    //COMPROBACIONES:
    /**
     * checkPasaje() --> Método para comprobar si el pasajero ya está en el vuelo o si el asiento está ocupado para dicho vuelo
     * @param type $post --> json con los parámetros a actualizar o insertar
     * @return type --> En caso de darse alguna de estas comprobaciones devolverá el texto con el error, en caso contrario no devolverá nada
     */
    public function checkPasaje($post) {
        try {
            //Consulta del pasajero/vuelo
            $sql = "SELECT * FROM $this->table WHERE pasajerocod=? AND identificador=?";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $post["pasajerocod"]);
            $stm->bindParam(2, $post["identificador"]);
            $stm->execute();
            $pasajero = $stm->fetch(PDO::FETCH_ASSOC);
            //Consulta del asiento/vuelo reescribiendo la consulta sql
            $sql = "SELECT * FROM $this->table WHERE numasiento=? AND identificador=?";
            $stm = $this->conexionDB->prepare($sql);
            $stm->bindParam(1, $post["numasiento"]);
            $stm->bindParam(2, $post["identificador"]);
            $stm->execute();
            $asiento = $stm->fetch(PDO::FETCH_ASSOC);
            if ($pasajero) {
                return "El pasajero " . $post['pasajerocod'] . " ya tiene una plaza en el vuelo " . $post['identificador'];
            } else if ($asiento) {
                return "El asiento " . $post['numasiento'] . " del vuelo " . $post["identificador"] . " está ocupado";
            }
        } catch (PDOException $e) {
            return "ERROR -> " . $e->getMessage();
        }
    }

}
