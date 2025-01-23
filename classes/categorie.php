<?php 
class categorie {
    private $categorie_id;
    private $categorie_name;

    public function __construct($categorie_id, $categorie_name) {
        $this->categorie_id = $categorie_id;
        $this->categorie_name = $categorie_name;
    }

    public function getCategorieId() {
        return $this->categorie_id;
    }

    public function getCategorieName() {
        return $this->categorie_name;
    }

    public static function getAllCategories(PDO $db) {
        $query = 'SELECT * FROM categories';
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getCategoryById(PDO $db, $categorie_id) {
        $query = 'SELECT * FROM categories WHERE categorie_id = :categorie_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function addCategory(PDO $db, $categorie_name, $categorie_description) {
        $query = 'INSERT INTO categories (categorie_name, categorie_description) VALUES (:categorie_name, :categorie_description)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categorie_name', $categorie_name);
        $stmt->bindParam(':categorie_description', $categorie_description);
        $stmt->execute();
    }

    public static function updateCategory(PDO $db, $categorie_id, $categorie_name, $categorie_description) {
        $query = 'UPDATE categories SET categorie_name = :categorie_name, categorie_description = :categorie_description WHERE categorie_id = :categorie_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':categorie_name', $categorie_name);
        $stmt->bindParam(':categorie_description', $categorie_description);
        $stmt->execute();

        return $stmt->rowCount();
    }
}