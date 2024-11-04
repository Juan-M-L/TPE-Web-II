<?php
require_once 'config.php';

class MainModel {
    protected $db;
    private $dbError;

    //Inicia conexión con la base de datos. 
    public function __construct() {
        try {
            //Realiza una nueva conexión, sin definir aún la base de datos.
            $this->db = new PDO(
                "mysql:host=".MYSQL_HOST,
                MYSQL_USER,
                MYSQL_PASS
            );

            //Verifica que la base de datos exista. Si no existe, la crea.
            $this->db->query("CREATE DATABASE IF NOT EXISTS ".MYSQL_DB.";");

            //Se conecta a la base de datos.
            $this->db->query("USE ".MYSQL_DB);

            $this->__deploy();
        } catch (PDOException $e) {
            $this->dbError = "Error de conexión con la base de datos: " . $e->getMessage();
        }
    }

    //Crea las tablas de la base de datos, si no hay tablas presentes.
    private function __deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = file_get_contents("autos.sql");
            $this->db->query($sql);
        }
    }

    //Obtiene el valor $dbError, que indica si hubo o no un error de conexión con la BD.
    public function getDBError() {
        return $this->dbError;
    }

    //VEHÍCULOS.

    //Consigue todos los datos uniendo los contenidos de ambas tablas.
    public function getVehicleData() {
        if ($this->dbError) return [];
        $data = $this->db->prepare("SELECT 
        Auto.Id as AutoId, 
        Auto.Marca, 
        Auto.ModeloId, 
        Auto.Precio, 
        Modelo.Nombre
        FROM Auto JOIN Modelo ON Auto.ModeloId = Modelo.Id;");
        $data->execute();
        return $data->fetchAll();
    }

    //Consigue un array con un vehículo que tiene el id solicitado.
    public function getById($id) {
        if ($this->dbError | $id == false) return [];
        $data = $this->db->prepare("SELECT 
        Auto.Id as AutoId, 
        Auto.Marca, 
        Auto.ModeloId, 
        Auto.Kilometraje, 
        Auto.Precio, 
        Modelo.Nombre, 
        Modelo.Anio, 
        Modelo.Capacidad, 
        Modelo.Combustible
        FROM Auto JOIN Modelo ON Auto.ModeloId = Modelo.Id
        WHERE auto.Id = ?;");
        $data->execute(array($id));
        return $data->fetchAll();
    }

    //Agrega un auto a la base de datos.
    public function addVehicle($marca, $modeloId, $kilometraje, $precio) {
        $data = $this->db->prepare("INSERT INTO Auto (Marca, ModeloId, Kilometraje, Precio) VALUES (?,?,?,?);");
        $data->execute(array($marca, $modeloId, $kilometraje, $precio));
    }

    public function updateVehicle($id, $marca, $modeloId, $kilometraje, $precio) {
        $data = $this->db->prepare("UPDATE Auto SET Marca = ?, ModeloId = ?, Kilometraje = ?, Precio = ? WHERE Id = ?;");
        $data->execute(array($marca, $modeloId, $kilometraje, $precio, $id));
    }

    public function deleteVehicle($id) {
        $data = $this->db->prepare("DELETE FROM Auto WHERE Id = ?;");
        $data->execute(array($id));
    }

    //CATEGORÍAS.

    // Obtiene todas las categorías (modelos)
    public function getAllCategories() {
        if ($this->dbError) return [];
        $data = $this->db->prepare("SELECT * FROM modelo;");
        $data->execute();
        return $data->fetchAll();
    }

    // Obtiene los datos de una categoria.
    public function getCategoryById($id) {
        if ($this->dbError | $id == false) return [];
        $data = $this->db->prepare("SELECT * FROM Modelo WHERE Id = ?;");
        $data->execute(array($id));
        return $data->fetchAll();
    }

    // Obtiene vehículos por categoría
    public function getVehiclesByCategory($categoryId) {
        if ($this->dbError || $categoryId == false) return [];
        $data = $this->db->prepare("SELECT * FROM auto JOIN modelo ON auto.ModeloId = modelo.Id WHERE modelo.Id = ?;");
        $data->execute(array($categoryId));
        return $data->fetchAll();
    }

    public function addCategory($nombre, $anio, $capacidad, $combustible) {
        $data = $this->db->prepare("INSERT INTO modelo (nombre, anio, capacidad, combustible) VALUES (?,?,?,?);");
        $data->execute(array($nombre, $anio, $capacidad, $combustible));
    }

    public function updateCategory($id, $nombre, $anio, $capacidad, $combustible) {
        $data = $this->db->prepare("UPDATE modelo SET Nombre = ?, Anio = ?, Capacidad = ?, Combustible = ? WHERE Id = ?;");
        $data->execute(array($nombre, $anio, $capacidad, $combustible, $id));
    }

    public function deleteCategory($id) {
        $data = $this->db->prepare("DELETE FROM modelo WHERE Id = ?");
        $data->execute(array($id));
    }
}
