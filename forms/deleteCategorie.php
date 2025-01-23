<?php 
require '../db.php';
require '../classes/categorie.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['categorie_id'])) {
        $categorie_id = $_POST['categorie_id'];

        $data = new Database;
        $conn = $data->getConnection();

        $result = categorie::deleteCategory($conn, $categorie_id);

        if ($result) {
            header('location: ../pages/admin/admin.php');
            exit();
        } else {
            echo "Failed to delete category";
        }
    }
}