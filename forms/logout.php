<?php
session_start();
require_once '../classes/user.php';

if (!isset($_SESSION['email'])){
    header("location : ../pages/login.php");
    exit();
} else {
    $user = new User();
}