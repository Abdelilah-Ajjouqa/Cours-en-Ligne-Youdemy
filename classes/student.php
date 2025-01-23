<?php 
class student {
    private $student_id;
    private $username;
    private $email;
    private $password;
    private $role;
    private $enrollment_id;

    public function __construct($student_id, $username, $email, $password, $role, $enrollment_id = null)
    {
        $this->student_id = $student_id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->enrollment_id = $enrollment_id;
    }

    public function getUserId()
    {
        return $this->student_id;
    }

    public function getUserName()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEnrollId()
    {
        return $this->enrollment_id;
    }

    public static function checkIfEnroll(PDO $db ,$student_id, $course_id)
    {
        $query = 'SELECT * FROM enrollments WHERE course_id = :course_id AND student_id = :student_id';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();

        return $stmt->fetch();
    }
}