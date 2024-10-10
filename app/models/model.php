<?php

class Model {
    private $db;

    //Cuando se crea un objeto modelo, éste objeto se conecta con la base de datos. 
    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;"."dbname=autos;charset=utf8","root","");
    }

    //El objeto consigue todos los datos uniendo los contenidos de ambas tablas.
    public function getData() {
        $data = $this->db->prepare("SELECT * FROM auto JOIN modelo ON auto.ModeloId = modelo.Id;");
        $data->execute();
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
