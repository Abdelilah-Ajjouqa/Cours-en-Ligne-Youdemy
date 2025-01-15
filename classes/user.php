<?php
class User implements Authentication
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAllCours(PDO $db)
    {
        $query = "SELECT * FROM courses";
        $stmt = $db->query($query);
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }

    public function getCourseDetails()
    {

    }

    public function register(PDO $db, $userName, $password, $comfirmPassword)
    {
        
    }

    public function login(PDO $db, $password)
    {

    }

    public function logout()
    {
        
    }

    public function isLoggedIn()
    {
        
    }

    public function isAdmin()
    {
        
    }

    public function isTeacher()
    {
        
    }

    public function isStudent()
    {
        
    }
}