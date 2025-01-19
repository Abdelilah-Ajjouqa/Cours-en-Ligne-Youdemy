<?php
session_start();
require '../classes/user.php';
require '../db.php';

$data = new Database;
$conn = $data->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $auth = new User($email, $conn);
        $result = $auth->login($conn, $password);

        if ($result){
            header('location: ../pages/home.php');
            exit();
        } else {
            echo "Invalid email or password";
        }
    }
}