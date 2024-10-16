<?php

class UserModel {
    private $db;
    private $dbError;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;"."dbname=autos;charset=utf8","root","");
        } catch (PDOException $e) {
            $this->dbError = "Error de conexión con la base de datos: " . $e->getMessage();
        }
    }

    public function getDBError () {
        return $this->dbError;
    }

    public function getUserByName($name) {
        if ($this->dbError) return [];
        $data = $this->db->prepare("SELECT * FROM Usuario WHERE Nombre = ?;");
        $data->execute(array($name)); 
        $user = $data->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}