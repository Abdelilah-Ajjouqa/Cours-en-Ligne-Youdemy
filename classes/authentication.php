<?php 

interface Authentication
{
    public function register(PDO $db, $userName, $password, $comfirmPassword);
    
    public function login(PDO $db, $password);

    public function logout();

    public function isLoggedIn();

    public function isAdmin();

    public function isTeacher();

    public function isStudent();
}