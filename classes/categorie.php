<?php 
class categorie {
    private $categorie_id;
    private $name;

    public function __construct($categorie_id, $name) {
        $this->categorie_id = $categorie_id;
        $this->name = $name;
    }

    // public function getCategorieId() {
    //     return $this->categorie_id;
    // }

    // public function getCategorieName() {
    //     return $this->name;
    // }

    public static function getAllCategories(PDO $db) {
        $query = 'SELECT * FROM categories';
        $stmt = $db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addCategory(PDO $db, $name) {
        $query = 'INSERT INTO categories (name) VALUES (:name)';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return true;
    }

    public static function updateCategory(PDO $db, $categorie_id, $name) {
        $query = 'UPDATE categories SET name = :name WHERE categorie_id = :categorie_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':name', $name);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public static function deleteCategory(PDO $db, $categorie_id) {
        $query = 'DELETE FROM categories WHERE categorie_id = :categorie_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->execute();

        return $stmt->rowCount();
    }
}