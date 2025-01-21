<?php
session_start();
require '../db.php';
require '../classes/user.php';

$data = new Database;
$conn = $data->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $role = $_POST['role'];

        $auth = new User($email, $conn);
        $result = $auth->register($conn, $firstname, $lastname, $username, $password, $confirmPassword, $role);

        if ($result === true) {
            header('location: ../pages/autho/login.html');
            exit();
        } else {
            echo $result;
        }
    }
}