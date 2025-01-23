<?php 

interface Authentication
{
    public function register(PDO $db, $firstname, $lastname, $userName, $password, $comfirmPassword, $role = 'Student');
    
    public function login(PDO $db, $password);

    public function logout();

    public function isLoggedIn();

    // public function isAdmin();

    public function isTeacher();

    public function isStudent();
}