<?php

class Model {
    private $db;

    //Inicia conexión con la base de datos. 
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;"."dbname=autos;charset=utf8","root","");
    }

    //Consigue todos los datos uniendo los contenidos de ambas tablas.
    public function getAllData() {
        $data = $this->db->prepare("SELECT 
        Auto.Id as AutoId, 
        Auto.Marca, 
        Auto.ModeloId, 
        Auto.Precio, 
        Modelo.Nombre as ModeloNombre
        FROM Auto JOIN Modelo ON Auto.ModeloId = Modelo.Id;");
        $data->execute();
        return $data->fetchAll();
    }

    //Consigue un array con un vehículo que tiene el id solicitado.
    public function getById($id) {
        $data = $this->db->prepare("SELECT 
        Auto.Id as AutoId, 
        Auto.Marca, 
        Auto.ModeloId, 
        Auto.Kilometraje, 
        Auto.Precio, 
        Modelo.Nombre as ModeloNombre, 
        Modelo.Anio, 
        Modelo.Capacidad, 
        Modelo.Combustible
        FROM Auto JOIN Modelo ON Auto.ModeloId = Modelo.Id
        WHERE auto.Id = ?;");
        $data->execute(array($id));
        return $data->fetchAll();
    }
}
