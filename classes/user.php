<?php
require 'authentication.php';

class User implements Authentication
{
    protected $email;
    protected $username;
    protected $firstname;
    protected $lastname;
    protected $role;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function register(PDO $db, $firstname, $lastname, $username, $password, $confirmPassword, $role = 'Student')
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
            $query = 'INSERT INTO users (firstname, lastname, username, email, password, role) VALUES (:firstname, :lastname, :username, :email, :password, :role)';
            $stmt = $db->prepare($query);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':role', $role);
            $stmt->execute();

            $userId = $db->lastInsertId();

            if ($userId) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $this->email;
                $_SESSION['role'] = $role;
            }

            return true;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function login(PDO $db, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $this->email);
            $stmt->execute();

            $logInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$logInfo || !password_verify($password, $logInfo['password'])) {
                header('location: ../pages/autho/login.hmtl');
                return false;
            } else {
                $_SESSION['username'] = $logInfo['username'];
                $_SESSION['email'] = $logInfo['email'];
                $_SESSION['role'] = $logInfo['role'];
                return true;
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getFirstName ()
    {
        return $this->firstname = $_SESSION['firstname'];
    }

    public function getLastName()
    {
        return $this->lastname = $_SESSION['lastname'];
    }

    public function getUserName()
    {
        return $this->username = $_SESSION['username'];
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        if ($_SESSION['role'] == 'student') {
            $role = 'student';
            return $this->role = $role;
        
        } elseif ($_SESSION['role'] == 'teacher') {
            $role = 'teacher';
            return $this->role = $role;

        } else {
            $role = 'admin';
            return $this->role = $role;
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        return true;
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['email'])) {
            return true;
        }
    }

    public function isAdmin()
    {
        if ($_SESSION['role'] === 'Admin') {
            return true;
        }
    }

    public function isTeacher()
    {
        if ($_SESSION['role'] === 'Teacher') {
            return true;
        }
    }

    public function isStudent()
    {
        if ($_SESSION['role'] === 'Student') {
            return true;
        }
    }

    public function getUserId()
    {
        return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    }
}
