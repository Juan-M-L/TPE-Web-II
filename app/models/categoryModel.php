
<?php
class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=autos', 'root', ''); // Asegúrate de usar las credenciales correctas.
    }

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT * FROM modelo"); // Cambia 'categoria' por el nombre correcto de tu tabla
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function addCategory($name, $year, $capacity, $fuelType) {
        $stmt = $this->db->prepare("INSERT INTO modelo (Nombre, Anio, Capacidad, Combustible) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $year, $capacity, $fuelType]);
    }
    

    public function editCategory($id, $name, $year, $capacity, $fuelType) {
        $stmt = $this->db->prepare("UPDATE modelo SET Nombre = ?, Anio = ?, Capacidad = ?, Combustible = ? WHERE Id = ?");
        return $stmt->execute([$name, $year, $capacity, $fuelType, $id]);
    }
    

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM modelo WHERE Id = ?"); // Cambia 'categoria' por el nombre correcto de tu tabla
        return $stmt->execute([$id]);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM modelo WHERE Id = ?"); // Cambia 'categoria' por el nombre correcto de tu tabla
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}

?>