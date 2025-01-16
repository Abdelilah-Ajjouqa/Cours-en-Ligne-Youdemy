<?php
require 'authentication.php';

class User implements Authentication
{
    protected $email;
    private $db;

    public function __construct($email, PDO $db)
    {
        $this->email = $email;
        $this->db = $db;
    }

    public function register(PDO $db, $username, $password, $confirmPassword, $role = 'Student')
    {
        try {
            // Check if email already exists
            $query = 'SELECT * FROM users WHERE email = :email';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "This email already exists";
            }

            if ($password !== $confirmPassword) {
                return "Passwords do not match";
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert Data
            $query = 'INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            $userId = $db->lastInsertId();

            if ($userId) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $this->email;
                $_SESSION['role'] = $role;
            }

            return true;

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
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