<?php
session_start();
require '../db.php';
require '../classes/user.php';

$data = new Database;
$conn = $data->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $role = 'user';
        
        $auth = new User($email, $db);
        $result = $auth->register($username, $email, $password, $confirmPassword, $role);
        
        if ($result === true) {
            header('location: ../pages/login.php');
            echo 'connect true';
            exit();
        } else {
            echo "<script>alert('$result');</script>";
        }
    }
}