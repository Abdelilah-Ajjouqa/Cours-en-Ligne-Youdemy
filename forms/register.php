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
        $role = $_POST['role'];

        $auth = new User($email, $conn);
        $result = $auth->register($conn, $username, $password, $confirmPassword, $role);

        if ($result === true) {
            header('location: ../pages/login.php');
            exit();
        } else {
            echo $result;
        }
    }
}