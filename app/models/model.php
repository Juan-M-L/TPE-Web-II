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

    // Obtiene todas las categorías (marcas)
    public function getAllCategories() {
        $data = $this->db->prepare("SELECT * FROM modelo;");
        $data->execute();
        return $data->fetchAll();
    }

    // Obtiene vehículos por categoría
    public function getVehiclesByCategory($categoryId) {
        $data = $this->db->prepare("SELECT * FROM auto JOIN modelo ON auto.ModeloId = modelo.Id WHERE modelo.Id = :categoryId;");
        $data->bindParam(':categoryId', $categoryId);
        $data->execute();
        return $data->fetchAll();
    }
}
