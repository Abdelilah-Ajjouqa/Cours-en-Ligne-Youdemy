<?php
class student
{
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

    public function getRole()
    {
        return $this->role;
    }

    public function getEnrollId()
    {
        return $this->enrollment_id;
    }

    public static function checkIfEnroll(PDO $db, $student_id)
    {
        $query = '
            SELECT u.username, e.course_id, e.student_id,  c.* FROM enrollments e
            join users u 
            on u.user_id = e.student_id
            join courses c
            on c.course_id = e.course_id 
            where student_id = :student_id;
        ';
        $stmt = $db->prepare($query);
        $stmt->bindParam(':student_id', $student_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}