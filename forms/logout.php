<?php
session_start();
require_once '../classes/user.php';

if (!isset($_SESSION['email'])){
    header("location : ../pages/autho/login.html");
    exit();
} else {
    $user = new User($_SESSION['email'], $db);
    $user->logout();
    header('location: ../pages/autho/login.html');
    exit();
}