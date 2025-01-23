<?php
require '../db.php';
require '../classes/categorie.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        $categorie_name = $_POST['name'];


        $data = new Database;
        $conn = $data->getConnection();

        $result = categorie::updateCategory($conn, $categorie_name, $categorie_id);

        if ($result) {
            header('location: ../pages/admin/admin.php');
            exit();
        } else {
            echo "Failed to add category";
        }
    }
}