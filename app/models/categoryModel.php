<?php
class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;dbname=autos;charset=utf8", "root", "");
    }

    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT * FROM modelo");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name, $anio, $capacidad, $combustible) {
        $stmt = $this->db->prepare("INSERT INTO modelo (Nombre, Anio, Capacidad, Combustible) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $anio, $capacidad, $combustible]);
    }

    public function getCategoryById($id) {
        $stmt = $this->db->prepare("SELECT * FROM modelo WHERE Id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCategory($id, $name, $anio, $capacidad, $combustible) {
        $stmt = $this->db->prepare("UPDATE modelo SET Nombre = ?, Anio = ?, Capacidad = ?, Combustible = ? WHERE Id = ?");
        return $stmt->execute([$name, $anio, $capacidad, $combustible, $id]);
    }

    public function deleteCategory($id) {
        $stmt = $this->db->prepare("DELETE FROM modelo WHERE Id = ?");
        return $stmt->execute([$id]);
    }
}
?>

