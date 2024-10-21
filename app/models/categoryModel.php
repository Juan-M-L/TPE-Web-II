<?php

class CategoryModel {
    private $db;

    public function __construct() {
        // Asegúrate de inicializar la conexión a la base de datos aquí
        $this->db = new PDO("mysql:host=localhost;"."dbname=autos;charset=utf8","root","");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }




    public function getAllCategories() {
        $stmt = $this->db->prepare("SELECT * FROM modelo");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener una categoría por su ID
    public function getById($id) {
        foreach ($this->categories as $category) {
            if ($category['Id'] == $id) {
                return $category;
            }
        }
        return null; // Si no se encuentra la categoría
    }

    // Agregar una nueva categoría
    public function addCategory($nombre, $anio, $capacidad, $combustible) {
        $newId = count($this->categories) + 1; // Generamos un ID simple
        $this->categories[] = ['Id' => $newId, 'Nombre' => $nombre];
    }

    // Actualizar una categoría existente
    public function updateCategory($id, $nombre) {
        foreach ($this->categories as &$category) {
            if ($category['Id'] == $id) {
                $category['Nombre'] = $nombre;
                return;
            }
        }
    }

    // Eliminar una categoría por su ID
    public function deleteCategory($id) {
        foreach ($this->categories as $key => $category) {
            if ($category['Id'] == $id) {
                unset($this->categories[$key]);
                return;
            }
        }
    }
}
?>
