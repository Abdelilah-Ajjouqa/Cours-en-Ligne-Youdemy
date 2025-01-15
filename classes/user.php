<?php
class User implements Authentication
{
    protected $email;
    private $db;

    public function __construct($email, PDO $db)
    {
        $this->email = $email;
        $this->db = $db;
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

    public function register(PDO $db, $userName, $password, $comfirmPassword, $role = 'Student')
    {
        try{
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert Data
            $query = 'INSERT INTO users (username, email, password, role) VALUE(:username, :email, :password, :role)';
            $stmt = $db->prepare($query);
            $stmt->bindParam('username', $username);
            $stmt->bindParam('email', $email);
            $stmt->bindParam('password', $hashedPassword);
            $stmt->bindParam('role', $role);
            $stmt->execute();

            $userId = $this->db->lastInsertId();

            if ($userId){
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
            }
            return true;

            // Check if email already exit
            $query = 'SELECT * FROM users WHERE email = :email';
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return "this Email is already exit";
            }
            if ($password !== $confirmPassword) {
                return "passwords do not match";
            }

        } catch(PDOException $e){
            echo 'Error : '. $e->getMessage();
        }
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